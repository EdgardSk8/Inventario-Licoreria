<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class DetalleVentaController extends Controller
{
    public function MostrarDetalleVenta($id)
    {
        $venta = Venta::with([
            'cliente',
            'usuario',
            'metodoPago',
            'detalles.producto'
        ])->findOrFail($id);

        return response()->json([
            'venta' => $venta
        ]);
    }
}
