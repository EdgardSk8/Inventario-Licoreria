<?php

namespace App\Http\Controllers;

use App\Models\Impuesto;
use App\Models\MetodoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\MovimientoCaja;
use App\Models\MovimientoInventario;
use App\Models\Caja;



class FacturacionController extends Controller
{

/*  ╔════════ Mostrar Productos POS ══════════╗ 
    ╚═════════════════════════════════════════╝ */
    
    public function MostrarProductosPOS(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'buscar' => 'nullable|string|max:150'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'mensajes' => $validator->errors()
                ], 400);
            }

            $query = Producto::where('estado_producto', 1);

            // 🔍 Buscador
            if ($request->filled('buscar')) {
                $query->where('nombre_producto', 'like', '%' . $request->buscar . '%');
            }

            $productos = $query->select(
                    'id_producto',
                    'nombre_producto',
                    'precio_venta',
                    'stock_actual',
                    'imagen_producto'
                )
                ->limit(20) // importante para rendimiento
                ->get();

            return response()->json([
                'success' => true,
                'data' => $productos
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener productos',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔════════ Mostrar Clientes POS ═══════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarClientesPOS(Request $request)
    {
        try {

            // Validar parámetros opcionales
            $validator = Validator::make($request->all(), [
                'estado' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'mensajes' => $validator->errors()
                ], 400);
            }

            // Consulta base
            $query = Cliente::query();

            // Filtrar por estado si se envía
            if ($request->has('estado')) {
                $query->where('estado_cliente', $request->estado);
            } else {
                // Por defecto, solo clientes activos
                $query->where('estado_cliente', 1);
            }

            $clientes = $query->orderBy('nombre_cliente', 'asc')->get();

            return response()->json([
                'success' => true,
                'total' => $clientes->count(),
                'data' => $clientes
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener los clientes',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


    public function FacturarProductosPOS(Request $request)
    {
        DB::beginTransaction();

        try {

            // 🔥 obtener caja abierta (SIN session)
            $caja = Caja::where('estado_caja', 1)->first();

            if (!$caja) {
                throw new \Exception('No hay caja abierta');
            }

            $numero = 'FAC-' . str_pad((Venta::count() + 1), 6, '0', STR_PAD_LEFT);

            $subtotalGeneral = 0;
            $impuestoGeneral = 0;

            $venta = Venta::create([
                'numero_factura' => $numero,
                'id_cliente' => $request->cliente,
                'id_usuario' => session('usuario.id'),
                'id_caja' => $caja->id_caja, // 🔥 AQUÍ
                'id_metodo_pago' => 1,
                'subtotal_venta' => 0,
                'impuesto_venta' => 0,
                'total_venta' => $request->total,
                'monto_recibido' => $request->recibido,
                'vuelto' => $request->recibido - $request->total
            ]);

            foreach ($request->carrito as $item) {

                $producto = Producto::with('impuesto')->find($item['id']);

                $precio = $item['precio'];
                $cantidad = $item['cantidad'];
                $porcentaje = $producto->impuesto->porcentaje_impuesto;

                $precioSinImpuesto = $precio / (1 + ($porcentaje / 100));
                $impuestoUnitario = $precio - $precioSinImpuesto;

                $subtotal = $precioSinImpuesto * $cantidad;
                $impuesto = $impuestoUnitario * $cantidad;

                $subtotalGeneral += $subtotal;
                $impuestoGeneral += $impuesto;

                DetalleVenta::create([
                    'id_venta' => $venta->id_venta,
                    'id_producto' => $producto->id_producto,
                    'cantidad_venta' => $cantidad,
                    'precio_unitario_venta' => $precio,
                    'subtotal_detalle_venta' => $subtotal,
                    'porcentaje_impuesto' => $porcentaje,
                    'monto_impuesto' => $impuesto
                ]);

                $stockAntes = $producto->stock_actual;
                $stockDespues = $stockAntes - $cantidad;

                $producto->decrement('stock_actual', $cantidad);

                MovimientoInventario::create([
                    'id_producto' => $producto->id_producto,
                    'tipo_movimiento' => 'SALIDA',        // siempre ENTRADA/SALIDA/AJUSTE
                    'cantidad_movimiento' => $cantidad,   // siempre positivo
                    'stock_resultante' => $stockDespues,  // nuevo campo
                    'motivo_movimiento' => 'Venta',
                    'id_referencia' => $venta->id_venta,
                    'tipo_referencia' => 'VENTA',         // nuevo campo
                    'precio_unitario' => $precio,          // opcional
                    'id_usuario' => session('usuario.id')
                ]);
            }

            $venta->update([
                'subtotal_venta' => $subtotalGeneral,
                'impuesto_venta' => $impuestoGeneral
            ]);
            

            // 💰 movimiento caja (ARREGLADO)
            MovimientoCaja::create([
                'id_caja' => $caja->id_caja, // 🔥 AQUÍ TAMBIÉN
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Venta',
                'monto_movimiento_caja' => $request->total,
                'id_usuario' => session('usuario.id'),
                'id_referencia' => $venta->id_venta
            ]);

            DB::commit();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'linea' => $e->getLine()
            ]);
        }
    }


/*  ╔════════ Mostrar Metodo Pago POS ════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarMetodoPagoPOS(Request $request){

        try {

            // Validar parámetros opcionales
            $validator = Validator::make($request->all(), [
                'estado' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'mensajes' => $validator->errors()
                ], 400);
            }

            // Consulta base
            $query = MetodoPago::query();

            // Filtrar por estado si se envía
            if ($request->has('estado')) {
                $query->where('estado_metodo_pago', $request->estado);
            } else {
                // Por defecto, solo clientes activos
                $query->where('estado_metodo_pago', 1);
            }

            $metodo_pago = $query->orderBy('nombre_metodo_pago', 'asc')->get();

            return response()->json([
                'success' => true,
                'total' => $metodo_pago->count(),
                'data' => $metodo_pago
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener los clientes',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


}
