<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    protected $table = 'movimientos_caja';
    protected $primaryKey = 'id_movimiento_caja';
    public $timestamps = false;

    protected $fillable = [
        'id_caja',
        'tipo_movimiento_caja',
        'concepto_movimiento_caja',
        'monto_movimiento_caja',
        'fecha_movimiento_caja',
        'id_usuario',
        'id_referencia',
        'id_cuenta_destino'
    ];

    // 🔹 Relación: pertenece a una caja
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'id_caja', 'id_caja');
    }

    // 🔹 Relación: pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // 🔹 Relación opcional: cuenta destino (para transferencias)
    public function cuentaDestino()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta_destino', 'id_cuenta');
    }
}
