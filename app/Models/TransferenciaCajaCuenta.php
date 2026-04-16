<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferenciaCajaCuenta extends Model
{
    protected $table = 'transferencias_caja_cuenta';
    protected $primaryKey = 'id_transferencia';
    public $timestamps = false;

    protected $fillable = [
        'id_caja_origen',
        'id_cuenta_destino',
        'monto',
        'concepto',
        'id_usuario',
        'fecha',
    ];

    // 🔹 Relación: Caja origen
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'id_caja_origen', 'id_caja');
    }

    // 🔹 Relación: Cuenta destino
    public function cuentaDestino()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta_destino', 'id_cuenta');
    }

    // 🔹 Usuario que hizo la transferencia
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // 🔹 Movimientos de caja asociados
    public function movimientosCaja()
    {
        return $this->hasMany(MovimientoCaja::class, 'id_transferencia', 'id_transferencia');
    }

    // 🔹 Movimientos de cuentas asociados
    public function movimientosCuenta()
    {
        return $this->hasMany(MovimientoCuenta::class, 'id_transferencia', 'id_transferencia');
    }
}