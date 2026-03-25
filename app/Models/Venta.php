<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    public $timestamps = false;

    protected $fillable = [
        'numero_factura',
        'fecha_venta',

        'id_cliente',
        'id_usuario',
        'id_caja',
        'id_cuenta',

        'subtotal_venta',
        'impuesto_venta',
        'total_venta',

        'estado_venta',

        'id_metodo_pago',

        'monto_recibido',
        'vuelto',
        'moneda'
    ];

    // 🔹 Relación: venta pertenece a cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // 🔹 Relación: venta pertenece a usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // 🔹 Relación: venta pertenece a caja
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'id_caja', 'id_caja');
    }

    // 🔹 Relación: venta pertenece a cuenta
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta', 'id_cuenta');
    }
    
    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago', 'id_metodo_pago');
    }

    // 🔹 Relación: una venta tiene muchos detalles
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id_venta');
    }

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla ventas se usa para registrar las transacciones de venta realizadas.

Cada registro representa una venta, donde se guarda:

- El número de factura
- La fecha y hora de la venta
- El cliente (si aplica)
- El usuario que realizó la venta
- La caja o cuenta utilizada
- El subtotal, impuesto y total de la venta
- El método de pago
- El monto recibido y el vuelto (si aplica)
- La moneda utilizada
- Su estado (activa o anulada)

La función de la tabla ventas es llevar control de las salidas de productos y los
ingresos de dinero del negocio.

══════════════════════════════════════════════════════════════════════════ */