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
        'descripcion_gasto',
        'monto_gasto',
        'id_usuario',
        'id_caja'
    ];

    // 🔹 Relación: gasto pertenece a un tipo de gasto
    public function tipoGasto()
    {
        return $this->belongsTo(TipoGasto::class, 'id_tipo_gasto', 'id_tipo_gasto');
    }

    // 🔹 Relación: gasto pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // 🔹 Relación: gasto pertenece a una caja
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'id_caja', 'id_caja');
    }

    // 🔹 Relación: opcional, si quieres enlazar con movimientos de caja
    public function movimientoCaja()
    {
        return $this->hasOne(MovimientoCaja::class, 'id_referencia', 'id_gasto')
                    ->where('tipo_movimiento_caja', 'SALIDA');
    }

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla gastos se usa para registrar los egresos de dinero del negocio.

Cada registro representa un gasto, donde se guarda:

- El tipo de gasto (ej: servicios, compras menores, mantenimiento)
- Una descripción del gasto
- El monto gastado
- La fecha y hora del gasto
- El usuario que lo registró
- La caja o cuenta desde donde se pagó (si aplica)

La función de la tabla gastos es llevar control del dinero que sale del negocio,
permitiendo un mejor seguimiento y administración de los egresos.

══════════════════════════════════════════════════════════════════════════ */