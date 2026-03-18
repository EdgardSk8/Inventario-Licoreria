<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuentas';
    protected $primaryKey = 'id_cuenta';
    public $timestamps = false;

    protected $fillable = [
        'nombre_cuenta',
        'tipo_cuenta',
        'descripcion',
        'saldo_actual',
        'estado'
    ];

    // 🔹 Relación: una cuenta tiene muchas compras
    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_cuenta', 'id_cuenta');
    }

    // 🔹 Relación: una cuenta tiene muchas ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_cuenta', 'id_cuenta');
    }

    // 🔹 Relación: una cuenta puede ser destino en movimientos de caja
    public function movimientosCajaDestino()
    {
        return $this->hasMany(MovimientoCaja::class, 'id_cuenta_destino', 'id_cuenta');
    }
}