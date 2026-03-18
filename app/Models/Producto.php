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
        'estado_producto'
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

    public function ubicacion() // 👈 NUEVA RELACIÓN
    {
        return $this->belongsTo(Ubicacion::class,'id_ubicacion');
    }
    
}
