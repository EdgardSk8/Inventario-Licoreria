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

/* ══════════════════════════════════════════════════════════════════════════

La tabla cuentas se usa para gestionar el dinero en diferentes cuentas del sistema.

Cada registro representa una cuenta (Origen del dinero), donde se guarda:

- El nombre de la cuenta (ej: caja general, banco, efectivo)
- El tipo de cuenta (ej: Bancaria, Ahorro, Efectivo etc.)
- Una descripción opcional
- El saldo actual disponible
- Su estado (activa o inactiva)
- Fechas de creación y actualización

La función de la tabla cuentas es llevar control del dinero disponible en
distintos medios, permitiendo registrar ingresos y egresos de forma organizada.

══════════════════════════════════════════════════════════════════════════ */