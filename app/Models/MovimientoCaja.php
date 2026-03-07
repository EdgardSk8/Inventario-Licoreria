<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    protected $table = 'movimientos_caja';
    protected $primaryKey = 'id_movimiento_caja';
    public $timestamps = false;

    protected $fillable = [
        'id_caja',
        'tipo_movimiento_caja',
        'concepto_movimiento_caja',
        'monto_movimiento_caja',
        'id_usuario',
        'id_referencia'
    ];
}
