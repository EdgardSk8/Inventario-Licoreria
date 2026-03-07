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
