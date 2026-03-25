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

/* ══════════════════════════════════════════════════════════════════════════

La tabla usuarios se usa para almacenar la información de las personas que usan el sistema.

Cada registro representa un usuario, donde se guarda:

- El nombre completo
- Su cédula de identidad
- El nombre de usuario y contraseña
- El rol asignado
- Su estado (activo o inactivo)
- La fecha de creación

La función de la tabla usuarios es controlar quién accede al sistema y qué puede
hacer según su rol.

══════════════════════════════════════════════════════════════════════════ */
