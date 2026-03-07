<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodos_pago';
    protected $primaryKey = 'id_metodo_pago';
    public $timestamps = false;

    protected $fillable = [
        'nombre_metodo_pago',
        'descripcion_metodo_pago',
        'estado_metodo_pago'
    ];
}
