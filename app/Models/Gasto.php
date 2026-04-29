<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $table = 'gastos';
    protected $primaryKey = 'id_gasto';
    public $timestamps = false;

    protected $fillable = [
        'id_tipo_gasto',
        'nombre_gasto',
        'fecha_inicio',
        'fecha_pago',
        'proximo_pago',
        'descripcion_gasto',
        'estado_gasto',
        'estado_pago',
        'ultimo_pago'
    ];

    // 🔹 Relación: pertenece a tipo
    public function tipoGasto()
    {
        return $this->belongsTo(TipoGasto::class, 'id_tipo_gasto');
    }

    // 🔹 Relación: historial de pagos
    public function movimientosGasto()
    {
        return $this->hasMany(MovimientoGasto::class, 'id_gasto');
    }
}

/* ══════════════════════════════════════════════════════════════════════════

La tabla gastos se usa como catálogo de los gastos fijos del negocio.

Cada registro representa un tipo de gasto (ej: luz, agua, salarios),
donde se guarda:

- El tipo de gasto al que pertenece (clasificación)
- El nombre del gasto
- Una descripción opcional
- Su estado (activo o inactivo)

Esta tabla NO almacena pagos ni movimientos de dinero.

La función de la tabla gastos es definir qué gastos existen en el sistema,
para luego registrar sus pagos en la tabla movimientos_gastos y así
llevar control del historial de egresos.

══════════════════════════════════════════════════════════════════════════ */