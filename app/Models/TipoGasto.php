<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoGasto extends Model
{
     protected $table = 'tipo_gasto';
    protected $primaryKey = 'id_tipo_gasto';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo_gasto',
        'descripcion_tipo_gasto',
        'estado_tipo_gasto'
    ];
}
