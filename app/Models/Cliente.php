<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = [
        'nombre_cliente',
        'cedula_cliente',
        'ruc_cliente',
        'telefono_cliente',
        'direccion_cliente',
        'correo_cliente',
        'estado_cliente'
    ];

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla clientes se usa para almacenar la información de las personas que compran.

Cada registro representa un cliente, donde se guarda:

- El nombre del cliente
- Su cédula o RUC (opcional)
- Teléfono, dirección y correo electrónico
- Su estado (activo o inactivo)
- La fecha de creación

La función de la tabla clientes es identificar a quién se le realizan las ventas,
permitiendo llevar historial de compras y un mejor control comercial.

══════════════════════════════════════════════════════════════════════════ */
