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


class CompraController extends Controller
{

/*  ╔═══════════ Registrar Compra ════════════╗ 
    ╚═════════════════════════════════════════╝ */
    public function RegistrarCompra(Request $request)
    {
        DB::beginTransaction();

        try {

            $caja = Caja::where('estado_caja', 1)->first();

            $subtotalGeneral = 0;

            $compra = Compra::create([
                'numero_factura_compra' => $request->numero_factura, // ✅ FACTURA REAL
                'id_proveedor' => $request->proveedor,
                'id_usuario' => session('usuario.id'),
                'id_caja' => $request->metodo_pago == 1 ? ($caja->id_caja ?? null) : null,
                'id_cuenta' => $request->cuenta ?? null,
                'id_metodo_pago' => $request->metodo_pago,
                'id_tipo_factura' => $request->tipo_factura,
                'subtotal_compra' => 0,
                'descuento_compra' => $request->descuento ?? 0,
                'impuesto_compra' => $request->impuesto ?? 0,
                'total_compra' => $request->total
            ]);

            foreach ($request->carrito as $item) {

                $producto = Producto::find($item['id']);

                if (!$producto) {
                    throw new \Exception('Producto no encontrado');
                }

                $precio = $item['precio'];
                $cantidad = $item['cantidad'];

                $subtotal = $precio * $cantidad;
                $subtotalGeneral += $subtotal;

                DetalleCompra::create([
                    'id_compra' => $compra->id_compra,
                    'id_producto' => $producto->id_producto,
                    'cantidad_compra' => $cantidad,
                    'precio_unitario_compra' => $precio,
                    'subtotal_detalle_compra' => $subtotal
                ]);

                // 📦 STOCK
                $stockAntes = $producto->stock_actual;
                $stockDespues = $stockAntes + $cantidad;

                $producto->increment('stock_actual', $cantidad);

                // 📊 KARDEX
                MovimientoInventario::create([
                    'id_producto' => $producto->id_producto,
                    'tipo_movimiento' => 'ENTRADA',
                    'cantidad_movimiento' => $cantidad,
                    'stock_resultante' => $stockDespues,
                    'motivo_movimiento' => 'Compra',
                    'id_referencia' => $compra->id_compra,
                    'tipo_referencia' => 'COMPRA',
                    'precio_unitario' => $precio,
                    'id_usuario' => session('usuario.id')
                ]);
            }

            $compra->update([
                'subtotal_compra' => $subtotalGeneral
            ]);

            // 💰 MOVIMIENTOS SEGÚN MÉTODO DE PAGO

            // 🟢 EFECTIVO → CAJA
            if ($request->metodo_pago == 1 && $caja) {

                MovimientoCaja::create([
                    'id_caja' => $caja->id_caja,
                    'tipo_movimiento_caja' => 'SALIDA',
                    'concepto_movimiento_caja' => 'Compra',
                    'monto_movimiento_caja' => $request->total,
                    'id_usuario' => session('usuario.id'),
                    'id_referencia' => $compra->id_compra
                ]);
            }

            // 🔵 BANCO → CUENTAS
            if ($request->cuenta) {

                MovimientoCuenta::create([
                    'id_cuenta' => $request->cuenta,
                    'tipo_movimiento' => 'SALIDA',
                    'monto' => $request->total,
                    'descripcion' => 'Compra',
                    'id_usuario' => session('usuario.id')
                ]);

                // actualizar saldo
                Cuenta::where('id_cuenta', $request->cuenta)
                    ->decrement('saldo_actual', $request->total);
            }

            DB::commit();

            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'linea' => $e->getLine()
            ]);
        }
    }




} // Fin de controlador
