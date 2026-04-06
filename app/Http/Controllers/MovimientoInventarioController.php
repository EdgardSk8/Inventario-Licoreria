<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoInventario;

class MovimientoInventarioController extends Controller
{

/*  ╔═════ Mostrar Movimiento Inventario ═════╗ 
    ╚═════════════════════════════════════════╝ */
    public function MostrarMovimientosInventario()
    {
        try {

            $movimientos = MovimientoInventario::select(
                    'movimientos_inventario.id_movimiento_inventario',
                    'movimientos_inventario.id_producto',
                    'productos.nombre_producto',
                    'movimientos_inventario.tipo_movimiento',
                    'movimientos_inventario.cantidad_movimiento',
                    'movimientos_inventario.stock_resultante',
                    'movimientos_inventario.motivo_movimiento',
                    'movimientos_inventario.id_referencia',
                    'movimientos_inventario.tipo_referencia',
                    'movimientos_inventario.precio_unitario',
                    'movimientos_inventario.fecha_movimiento',
                    'movimientos_inventario.id_usuario',
                    'usuarios.nombre_completo_usuario'
                )
                ->join('productos', 'movimientos_inventario.id_producto', '=', 'productos.id_producto')
                ->join('usuarios', 'movimientos_inventario.id_usuario', '=', 'usuarios.id_usuario')
                ->orderBy('movimientos_inventario.fecha_movimiento', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'movimientos' => $movimientos
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener movimientos de inventario',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }
    
}
