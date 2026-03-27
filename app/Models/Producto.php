<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre_producto',
        'descripcion_producto',
        'id_categoria',
        'id_impuesto',
        'id_ubicacion',
        'imagen_producto',
        'precio_compra',
        'precio_venta',
        'stock_actual',
        'estado_producto',
        'fecha_creacion_producto'
    ];

    // 🔗 Relaciones

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'id_categoria');
    }

    public function impuesto()
    {
        return $this->belongsTo(Impuesto::class,'id_impuesto');
    }

    public function ubicacion() 
    {
        return $this->belongsTo(Ubicacion::class,'id_ubicacion');
    }
    
}

/* ══════════════════════════════════════════════════════════════════════════

La tabla productos se usa para almacenar la información de los productos del negocio.

Cada registro representa un producto, donde se guarda:

- El nombre y descripción del producto
- La categoría, impuesto y ubicación
- Una imagen (opcional)
- El precio de compra y precio de venta
- El stock actual disponible
- Su estado (activo o inactivo)
- La fecha de creación

La función de la tabla productos es gestionar el inventario, permitiendo controlar
precios, stock y organización de los productos.

══════════════════════════════════════════════════════════════════════════ */
