<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    public $timestamps = false;

    protected $fillable = [
        'numero_factura',
        'id_cliente',
        'id_usuario',
        'id_caja',
        'subtotal_venta',
        'impuesto_venta',
        'total_venta',
        'estado_venta',
        'id_metodo_pago'
    ];
}
