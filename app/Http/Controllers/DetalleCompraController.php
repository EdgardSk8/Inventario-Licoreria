<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;

class DetalleCompraController extends Controller
{
    public function MostrarDetalleCompra($id)
    {
        $compra = Compra::with([
            'proveedor',
            'usuario',
            'metodoPago',
            'detalles.producto'
        ])->findOrFail($id);

        return response()->json([
            'compra' => $compra
        ]);
    }
}
