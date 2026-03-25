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

/* ══════════════════════════════════════════════════════════════════════════

La tabla impuestos se usa para definir los impuestos aplicados a los productos.

Cada registro representa un impuesto, donde se guarda:

- El nombre del impuesto (ej: IVA)
- El porcentaje que se aplica
- Su estado (activo o inactivo)
- La fecha de creación

La función de la tabla impuestos es permitir calcular automáticamente los
impuestos en las ventas y mantener un control centralizado de los mismos.

══════════════════════════════════════════════════════════════════════════ */
