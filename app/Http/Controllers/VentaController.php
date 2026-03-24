<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentaController extends Controller
{


/*  ╔════════════ Mostrar Venta ═══════════╗ 
    ╚══════════════════════════════════════╝ */
    
    public function MostrarVentas()
    {
        try {

            $ventas = Venta::with([
                'cliente',
                'usuario',
                'metodoPago',
                'detalles'
            ])->get();

            return response()->json([
                'success' => true,
                'ventas' => $ventas
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener ventas',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }


}
