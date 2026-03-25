<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credenciales extends Model
{
    protected $table = 'configuracion_empresa';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_empresa',
        'ruc_empresa',
        'direccion_empresa',
        'telefono_empresa',
        'correo_empresa',
    ];
}
