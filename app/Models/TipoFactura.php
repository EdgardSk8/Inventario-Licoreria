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
