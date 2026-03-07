<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre_completo_usuario',
        'cedula_identidad_usuario',
        'nombre_usuario',
        'password_hash_usuario',
        'id_rol_usuario',
        'estado_usuario'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class,'id_rol_usuario');
    }
}
