<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
     protected $table = 'rol_permiso';
    protected $primaryKey = 'id_rol_permiso';
    public $timestamps = false;

    protected $fillable = [
        'id_rol',
        'id_permiso'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'id_permiso');
    }

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla rol_permiso se usa para relacionar los roles con los permisos.

Cada registro representa la asignación de un permiso a un rol, donde se guarda:

- El rol asignado
- El permiso asignado
- La fecha en que se realizó la asignación

La función de la tabla rol_permiso es definir qué acciones puede realizar cada rol
dentro del sistema.

══════════════════════════════════════════════════════════════════════════ */
