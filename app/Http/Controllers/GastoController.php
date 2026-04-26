<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;

class GastoController extends Controller
{

/*  ╔════════════ Mostrar Gastos ════════════╗ 
    ╚════════════════════════════════════════╝ */
    
    public function MostrarGastos()
    {
        try {

            $gastos = Gasto::all();

            return response()->json([
                'success' => true,
                'gastos' => $gastos
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener gastos',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

}
