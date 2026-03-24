<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id_detalle_venta';
    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad_venta',
        'precio_unitario_venta',
        'subtotal_detalle_venta',
        'porcentaje_impuesto',
        'monto_impuesto',
    ];
}
