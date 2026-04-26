<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoGasto extends Model
{
    protected $table = 'movimientos_gastos';
    protected $primaryKey = 'id_movimiento_gasto';
    public $timestamps = false;

    protected $fillable = [
        'id_gasto',
        'monto',
        'origen',
        'id_caja',
        'id_cuenta',
        'fecha',
        'id_usuario',
        'observacion'
    ];

    // 🔹 Relación: pertenece a gasto
    public function gasto()
    {
        return $this->belongsTo(Gasto::class, 'id_gasto');
    }

    // 🔹 Relación: pertenece a usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    // 🔹 Relación: pertenece a caja (opcional)
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'id_caja');
    }

    // 🔹 Relación: pertenece a cuenta (opcional)
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta');
    }
}