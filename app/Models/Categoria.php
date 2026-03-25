<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    protected $fillable = [
        'nombre_categoria',
        'descripcion_categoria',
        'estado_categoria'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class,'id_categoria');
    }

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla categoria se usa para organizar los productos dentro del sistema.

Cada registro representa una categoría, donde se guarda:

- El nombre de la categoría (ej: bebidas, licores, snacks)
- Una descripción opcional
- Su estado (activa o inactiva)
- La fecha de creación

La función de la tabla categoria es clasificar los productos para facilitar su
búsqueda, control y organización dentro del inventario.

══════════════════════════════════════════════════════════════════════════ */
