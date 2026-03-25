<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    protected $table = 'movimientos_inventario';
    protected $primaryKey = 'id_movimiento_inventario';
    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'tipo_movimiento',        // ENTRADA, SALIDA, AJUSTE
        'cantidad_movimiento',    // siempre positivo
        'stock_resultante',       // stock después del movimiento
        'motivo_movimiento',      // opcional
        'id_referencia',          // id de venta, compra, etc.
        'tipo_referencia',        // VENTA, COMPRA, DEVOLUCION, TRASLADO, AJUSTE
        'precio_unitario',        // opcional, para kardex valorizado
        'fecha_movimiento',
        'id_usuario'
    ];

    // 🔗 Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    // 🔗 Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

}
