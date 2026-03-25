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

/* ══════════════════════════════════════════════════════════════════════════

La tabla ubicaciones se usa para definir los lugares donde se almacenan los productos.

Cada registro representa una ubicación, donde se guarda:

- El nombre de la ubicación (ej: bodega-C, estante-A, almacén-B)
- Una descripción opcional
- Su estado (activa o inactiva)

La función de la tabla ubicaciones es organizar físicamente los productos dentro
del inventario, facilitando su localización y control.

══════════════════════════════════════════════════════════════════════════ */
