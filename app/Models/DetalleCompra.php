<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compras';
    protected $primaryKey = 'id_detalle_compra';
    public $timestamps = false;

    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad_compra',
        'precio_unitario_compra',
        'subtotal_detalle_compra'
    ];
}
