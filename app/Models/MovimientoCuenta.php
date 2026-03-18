<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCuenta extends Model
{
    protected $table = 'movimientos_cuentas';
    protected $primaryKey = 'id_movimiento_cuenta';
    public $timestamps = false;

    protected $fillable = [
        'id_cuenta',
        'tipo_movimiento',
        'descripcion',
        'monto',
        'fecha'
    ];

    // 🔹 Relación: pertenece a una cuenta
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta', 'id_cuenta');
    }
}