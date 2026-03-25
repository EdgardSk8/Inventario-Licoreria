<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFactura extends Model
{
    protected $table = 'tipos_factura';

    protected $primaryKey = 'id_tipo_factura';

    public $incrementing = true;
    protected $keyType = 'int';

    // ✔ Sí usa timestamps (porque tu tabla los tiene)
    public $timestamps = true;

    protected $fillable = [
        'nombre_tipo_factura',
        'descripcion_tipo_factura',
        'estado'
    ];

    protected $casts = [
        'estado' => 'boolean'
    ];

    // 🔹 Relación: un tipo de factura tiene muchas compras
    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_tipo_factura', 'id_tipo_factura');
    }

}

/* ══════════════════════════════════════════════════════════════════════════

La tabla tipos_factura se usa para definir los tipos de comprobantes de venta o compra.

Cada registro representa un tipo de factura, donde se guarda:

- El nombre del tipo de factura (ej: contado, crédito)
- Una descripción opcional
- Su estado (activo o inactivo)
- Fechas de creación y actualización

La función de la tabla tipos_factura es clasificar las transacciones según su tipo,
facilitando el control y la gestión administrativa.

══════════════════════════════════════════════════════════════════════════ */
