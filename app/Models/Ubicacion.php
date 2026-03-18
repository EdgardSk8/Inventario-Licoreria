<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';
    protected $primaryKey = 'id_ubicacion';
    public $timestamps = false;

    protected $fillable = [
        'nombre_ubicacion',
        'descripcion_ubicacion',
        'estado_ubicacion'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_ubicacion');
    }
}
