<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';
    public $timestamps = false;

    protected $fillable = [
        'nombre_proveedor',
        'ruc_proveedor',
        'telefono_proveedor',
        'direccion_proveedor',
        'correo_proveedor',
        'estado_proveedor'
    ];
}

/* ══════════════════════════════════════════════════════════════════════════

La tabla proveedores se usa para almacenar la información de quienes suministran productos.

Cada registro representa un proveedor, donde se guarda:

- El nombre del proveedor (empresa)
- Su RUC (opcional)
- Teléfono, dirección y correo electrónico
- Su estado (activo o inactivo)
- La fecha de creación

La función de la tabla proveedores es identificar de dónde provienen los productos,
facilitando la gestión de compras y relaciones comerciales.

══════════════════════════════════════════════════════════════════════════ */