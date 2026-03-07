<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $table = 'impuestos';
    protected $primaryKey = 'id_impuesto';
    public $timestamps = false;

    protected $fillable = [
        'nombre_impuesto',
        'porcentaje_impuesto',
        'estado_impuesto'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class,'id_impuesto');
    }
}
