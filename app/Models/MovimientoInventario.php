<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    protected $table = 'movimientos_inventario';
    protected $primaryKey = 'id_movimiento_inventario';
    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'tipo_movimiento',
        'cantidad_movimiento',
        'motivo_movimiento',
        'id_referencia',
        'id_usuario'
    ];
}
