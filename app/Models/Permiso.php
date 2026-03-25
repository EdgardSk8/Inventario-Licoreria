<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';
    protected $primaryKey = 'id_permiso';
    public $timestamps = false;

    protected $fillable = [
        'nombre_permiso',
        'descripcion_permiso',
        'modulo_permiso',
        'estado_permiso'
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class,'rol_permiso','id_permiso','id_rol');
    }

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla permisos se usa para definir las acciones que se pueden realizar en el sistema.

Cada registro representa un permiso, donde se guarda:

- El nombre del permiso
- Una descripción opcional
- El módulo al que pertenece (Usuario, proveedores, clientes etc)
- Su estado (activo o inactivo)
- La fecha de creación

La función de la tabla permisos es controlar el acceso a las funcionalidades
del sistema según el rol del usuario.

══════════════════════════════════════════════════════════════════════════ */
