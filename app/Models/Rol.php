<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    public $timestamps = false;

    protected $fillable = [
        'nombre_rol',
        'descripcion_rol',
        'estado_rol'
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class,'id_rol_usuario');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class,'rol_permiso','id_rol','id_permiso');
    }
}

/* ══════════════════════════════════════════════════════════════════════════

La tabla roles se usa para definir los tipos de usuarios dentro del sistema.

Cada registro representa un rol, donde se guarda:

- El nombre del rol (ej: administrador, cajero)
- Una descripción opcional
- Su estado (activo o inactivo)
- La fecha de creación

La función de la tabla roles es agrupar permisos y asignarlos a los usuarios,
permitiendo controlar qué puede hacer cada uno en el sistema.

══════════════════════════════════════════════════════════════════════════ */

