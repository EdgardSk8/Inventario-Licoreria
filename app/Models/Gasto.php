<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $table = 'gastos';
    protected $primaryKey = 'id_gasto';
    public $timestamps = false;

    protected $fillable = [
        'id_tipo_gasto',
        'descripcion_gasto',
        'monto_gasto',
        'id_usuario',
        'id_caja'
    ];
}
