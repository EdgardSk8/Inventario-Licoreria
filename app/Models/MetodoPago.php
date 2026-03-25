<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodos_pago';
    protected $primaryKey = 'id_metodo_pago';
    public $timestamps = false;

    protected $fillable = [
        'nombre_metodo_pago',
        'descripcion_metodo_pago',
        'estado_metodo_pago'
    ];

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla metodos_pago se usa para definir las formas en que se realizan los pagos.

Cada registro representa un método de pago, donde se guarda:

- El nombre del método (ej: efectivo, tarjeta, transferencia)
- Una descripción opcional
- Su estado (activo o inactivo)

La función de la tabla metodos_pago es estandarizar y controlar cómo se realizan
los pagos en compras y ventas dentro del sistema.

══════════════════════════════════════════════════════════════════════════ */
