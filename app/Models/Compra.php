<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id_compra';
    public $timestamps = false;

    protected $fillable = [
        'numero_factura_compra',
        'id_proveedor',
        'subtotal_compra',
        'impuesto_compra',
        'total_compra',
        'estado_compra',
        'id_usuario'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class,'id_proveedor');
    }
}
