<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoGasto extends Model
{
     protected $table = 'tipo_gasto';
    protected $primaryKey = 'id_tipo_gasto';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo_gasto',
        'descripcion_tipo_gasto',
        'estado_tipo_gasto'
    ];

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla tipo_gasto se usa para clasificar los diferentes tipos de gastos del negocio.

Cada registro representa un tipo de gasto, donde se guarda:

- El nombre del tipo de gasto (ej: servicios, mantenimiento)
- Una descripción opcional
- Su estado (activo o inactivo)

La función de la tabla tipo_gasto es organizar los gastos para facilitar su control
y análisis dentro del sistema.

══════════════════════════════════════════════════════════════════════════ */
