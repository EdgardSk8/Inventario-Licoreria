<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Caja;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\DetalleCompra;
use App\Models\MovimientoInventario;
use App\Models\MovimientoCaja;
use App\Models\MovimientoCuenta;
use App\Models\Cuenta;
use App\Models\Proveedor;
use App\Models\TipoFactura;
use App\Models\MetodoPago;



class CompraController extends Controller
{

/*  ╔═══════════ Registrar Compra ════════════╗ 
    ╚═════════════════════════════════════════╝ */
    public function RegistrarCompra(Request $request)
    {
        DB::beginTransaction();

        try {
            // =====================
            // 1️⃣ VALIDACIÓN
            // =====================
            $validator = Validator::make($request->all(), [
                'proveedor' => 'required|exists:proveedores,id_proveedor',
                'metodo_pago' => 'required|exists:metodos_pago,id_metodo_pago',
                'tipo_factura' => 'required|exists:tipos_factura,id_tipo_factura',
                'caja' => 'nullable|exists:cajas,id_caja',
                'cuenta' => 'nullable|exists:cuentas,id_cuenta',
                'carrito' => 'required|array|min:1',
                'carrito.*.id' => 'required|exists:productos,id_producto',
                'carrito.*.cantidad' => 'required|numeric|min:1',
                'carrito.*.precio' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                // Para toast, devolvemos solo el primer error o un mensaje general
                $mensaje = $validator->errors()->first() ?? 'Datos inválidos';
                return response()->json([
                    'success' => false,
                    'mensaje' => $mensaje
                ], 422);
            }

            // =====================
            // 2️⃣ VALIDAR FUENTE DE PAGO
            // =====================
            $usaCaja = $request->filled('caja');
            $usaCuenta = $request->filled('cuenta');

            if (!$usaCaja && !$usaCuenta) {
                return response()->json(['success' => false, 'mensaje' => 'Debe seleccionar caja o cuenta'], 422);
            }

            if ($usaCaja && $usaCuenta) {
                return response()->json(['success' => false, 'mensaje' => 'No puede pagar con caja y cuenta al mismo tiempo'], 422);
            }

            // =====================
            // 3️⃣ CALCULAR SUBTOTAL Y TOTAL
            // =====================
            $subtotalGeneral = 0;
            foreach ($request->carrito as $item) {
                $producto = Producto::find($item['id']);
                if (!$producto) {
                    return response()->json(['success' => false, 'mensaje' => 'Producto no encontrado: ' . $item['id']], 422);
                }
                $subtotalGeneral += $item['precio'] * $item['cantidad'];
            }

            $descuento = $request->descuento ?? 0;
            $impuesto = $request->impuesto ?? 0;
            $totalCalculado = $subtotalGeneral - $descuento + $impuesto;

            if ($totalCalculado < 0) {
                return response()->json(['success' => false, 'mensaje' => 'Total inválido'], 422);
            }

            // =====================
            // 4️⃣ CREAR COMPRA
            // =====================
            $compra = Compra::create([
                'numero_factura_compra' => $request->numero_factura,
                'id_proveedor' => $request->proveedor,
                'id_usuario' => session('usuario.id'),
                'id_caja' => $usaCaja ? $request->caja : null,
                'id_cuenta' => $usaCuenta ? $request->cuenta : null,
                'id_metodo_pago' => $request->metodo_pago,
                'id_tipo_factura' => $request->tipo_factura,
                'subtotal_compra' => $subtotalGeneral,
                'descuento_compra' => $descuento,
                'impuesto_compra' => $impuesto,
                'total_compra' => $totalCalculado
            ]);

            // =====================
            // 5️⃣ DETALLES, STOCK Y KARDEX
            // =====================
            foreach ($request->carrito as $item) {
                $producto = Producto::find($item['id']);
                $cantidad = $item['cantidad'];
                $precio = $item['precio'];

                DetalleCompra::create([
                    'id_compra' => $compra->id_compra,
                    'id_producto' => $producto->id_producto,
                    'cantidad_compra' => $cantidad,
                    'precio_unitario_compra' => $precio,
                    'subtotal_detalle_compra' => $precio * $cantidad
                ]);

                // Actualizar STOCK
                $producto->increment('stock_actual', $cantidad);

                // Registrar KARDEX
                MovimientoInventario::create([
                    'id_producto' => $producto->id_producto,
                    'tipo_movimiento' => 'ENTRADA',
                    'cantidad_movimiento' => $cantidad,
                    'stock_resultante' => $producto->stock_actual,
                    'motivo_movimiento' => 'Compra',
                    'id_referencia' => $compra->id_compra,
                    'tipo_referencia' => 'COMPRA',
                    'precio_unitario' => $precio,
                    'id_usuario' => session('usuario.id')
                ]);
            }

            // =====================
            // 6️⃣ MOVIMIENTO DE CAJA O CUENTA
            // =====================
            if ($usaCaja) {
                $caja = Caja::find($request->caja);
                if (!$caja) {
                    return response()->json(['success' => false, 'mensaje' => 'Caja no encontrada'], 422);
                }

                MovimientoCaja::create([
                    'id_caja' => $caja->id_caja,
                    'tipo_movimiento_caja' => 'SALIDA',
                    'concepto_movimiento_caja' => 'Compra',
                    'monto_movimiento_caja' => $totalCalculado,
                    'id_usuario' => session('usuario.id'),
                    'id_referencia' => $compra->id_compra,
                ]);
            }

            if ($usaCuenta) {
                $cuenta = Cuenta::find($request->cuenta);
                if (!$cuenta) {
                    return response()->json(['success' => false, 'mensaje' => 'Cuenta no encontrada'], 422);
                }

                if ($cuenta->saldo_actual < $totalCalculado) {
                    return response()->json(['success' => false, 'mensaje' => 'Saldo insuficiente en cuenta'], 422);
                }

                MovimientoCuenta::create([
                    'id_cuenta' => $cuenta->id_cuenta,
                    'tipo_movimiento' => 'SALIDA',
                    'monto' => $totalCalculado,
                    'descripcion' => 'Compra',
                    'id_usuario' => session('usuario.id')
                ]);

                $cuenta->decrement('saldo_actual', $totalCalculado);
            }

            DB::commit();

            // =====================
            // 7️⃣ MENSAJE EXITOSO
            // =====================
            return response()->json([
                'success' => true,
                'mensaje' => 'Compra registrada correctamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error al registrar compra: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'mensaje' => 'Ocurrió un error al registrar la compra: ' . $e->getMessage()
            ], 500);
        }
    }

/*  ╔══════════ Mostrar Proveedores ══════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarProveedoresCompras(Request $request)
    {
        try {

            // 🔍 VALIDACIÓN
            $validator = Validator::make($request->all(), [
                'q' => 'nullable|string|max:100',
                'estado' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'mensajes' => $validator->errors()
                ], 400);
            }

            // 🔎 CONSULTA BASE
            $query = Proveedor::query();

            // 🟢 FILTRO POR ESTADO
            if ($request->has('estado')) {
                $query->where('estado_proveedor', $request->estado);
            } else {
                // por defecto solo activos
                $query->where('estado_proveedor', 1);
            }

            // 🔍 BÚSQUEDA (Select2 usa "q")
            if ($request->filled('q')) {
                $busqueda = $request->q;

                $query->where(function ($q) use ($busqueda) {
                    $q->where('nombre_proveedor', 'like', "%{$busqueda}%")
                    ->orWhere('ruc_proveedor', 'like', "%{$busqueda}%");
                });
            }

            $proveedores = $query
                ->orderBy('nombre_proveedor', 'asc')
                ->limit(20)
                ->get();

            // 🎯 FORMATO SELECT2
            $data = $proveedores->map(function ($p) {
                return [
                    'id' => $p->id_proveedor,
                    'text' => $p->nombre_proveedor
                ];
            });

            return response()->json([
                'success' => true,
                'total' => $data->count(),
                'data' => $data
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener proveedores',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔════════ Mostrar Tipo de Factura ════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarTiposFacturaCompras()
    {
        try {

            $tipos = TipoFactura::where('estado', 1)
                ->orderBy('nombre_tipo_factura', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tipos
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener tipos de factura',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔═════════ Mostrar Tipo de Pago ══════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarMetodosPagoCompras()
    {
        try {

            $metodos = MetodoPago::where('estado_metodo_pago', 1)
                ->orderBy('nombre_metodo_pago', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $metodos
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener métodos de pago',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔════════════ Mostrar Cuentas ════════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarCuentasCompras()
    {
        try {
            // Trae solo las cuentas activas
            $cuentas = Cuenta::where('estado', 1)
                ->orderBy('nombre_cuenta', 'asc')
                ->get();

            // Formatea los datos para el <select>
            $data = $cuentas->map(function ($cuenta) {
                return [
                    'id' => $cuenta->id_cuenta, // valor real que se envía al backend
                    'nombre' => $cuenta->nombre_cuenta,
                    'saldo_actual' => number_format($cuenta->saldo_actual, 2),
                    'display' => "{$cuenta->nombre_cuenta} (Saldo: C$ " . number_format($cuenta->saldo_actual, 2) . ")"
                ];
            });

            return response()->json([
                'success' => true,
                'cuentas' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al obtener cuentas'
            ], 500);
        }
    }

/*  ╔════════════ Proceso de cajas ═══════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function procesarPagoCaja($totalCompra, $idCompra = null)
    {
        $idUsuario = session('usuario.id');
        if (!$idUsuario) throw new \Exception('Sesión no válida');

        $caja = Caja::where('estado_caja', 1)
            ->where('id_usuario', $idUsuario)
            ->orderBy('fecha_apertura', 'desc')
            ->first();

        if (!$caja) throw new \Exception('No tienes una caja abierta');

        $ingresos = MovimientoCaja::where('id_caja', $caja->id_caja)
            ->where('tipo_movimiento_caja', 'ENTRADA')
            ->sum('monto_movimiento_caja');

        $egresos = MovimientoCaja::where('id_caja', $caja->id_caja)
            ->where('tipo_movimiento_caja', 'SALIDA')
            ->sum('monto_movimiento_caja');

        $saldoActual = $caja->monto_inicial + $ingresos - $egresos;

        if ($saldoActual < $totalCompra) {
            throw new \Exception('Saldo insuficiente en caja');
        }

        MovimientoCaja::create([
            'id_caja' => $caja->id_caja,
            'tipo_movimiento_caja' => 'SALIDA',
            'concepto_movimiento_caja' => 'Compra',
            'monto_movimiento_caja' => $totalCompra,
            'id_usuario' => $idUsuario,
            'id_referencia' => $idCompra ?? null
        ]);

        return $caja;
    }

/*  ╔════════ Mostrar Cajas Abiertas ═════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarCajasAbiertas(Request $request)
    {
        $idUsuario = session('usuario.id');
        $totalCompra = $request->total ?? 0; // opcional para validar si hay suficiente saldo

        $cajas = Caja::where('estado_caja', 1)
                    ->get(); // podemos filtrar por usuario si quieres

        $data = $cajas->map(function ($caja) use ($totalCompra) {

            // calcular saldo en tiempo real
            $ingresos = MovimientoCaja::where('id_caja', $caja->id_caja)
                        ->where('tipo_movimiento_caja', 'INGRESO')
                        ->sum('monto_movimiento_caja');

            $salidas = MovimientoCaja::where('id_caja', $caja->id_caja)
                        ->where('tipo_movimiento_caja', 'SALIDA')
                        ->sum('monto_movimiento_caja');

            $saldoActual = $caja->monto_inicial + $ingresos - $salidas;

            return [
                'id' => $caja->id_caja,
                'text' => "{$caja->usuario->nombre_completo_usuario} (Saldo: C$ ".number_format($saldoActual, 2).")",
                'saldo_actual' => $saldoActual
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }



/*  ╔═══════════ Mostrar Productos ═══════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarProductosCompras(Request $request)
    {
        try {
            // 🔍 VALIDACIÓN
            $validator = Validator::make($request->all(), [
                'q' => 'nullable|string|max:150',
                'estado' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'mensajes' => $validator->errors()
                ], 400);
            }

            // 🔎 CONSULTA BASE
            $query = Producto::query();

            // 🟢 FILTRO POR ESTADO
            if ($request->has('estado')) {
                $query->where('estado_producto', $request->estado);
            } else {
                // por defecto solo activos
                $query->where('estado_producto', 1);
            }

            // 🔍 BÚSQUEDA (Select2 usa "q")
            if ($request->filled('q')) {
                $busqueda = $request->q;

                $query->where(function ($q) use ($busqueda) {
                    $q->where('nombre_producto', 'like', "%{$busqueda}%")
                    ->orWhere('descripcion_producto', 'like', "%{$busqueda}%");
                });
            }

            $productos = $query
                ->orderBy('nombre_producto', 'asc')
                ->limit(20)
                ->get();

            // 🎯 FORMATO SELECT2
            $data = $productos->map(function ($p) {
                return [
                    'id' => $p->id_producto,
                    'text' => $p->nombre_producto
                ];
            });

            return response()->json([
                'success' => true,
                'total' => $data->count(),
                'data' => $data
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener productos',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

} // Fin de controlador
