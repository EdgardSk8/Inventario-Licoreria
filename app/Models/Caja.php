<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'cajas';

    protected $primaryKey = 'id_caja';

    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'fecha_apertura',
        'fecha_cierre',
        'monto_inicial',
        'monto_final',
        'estado_caja',
        'id_usuario'
    ];

    // 🔹 Relación: una caja pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // 🔹 Relación: una caja tiene muchas ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_caja', 'id_caja');
    }

    // 🔹 Relación: una caja tiene muchas compras
    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_caja', 'id_caja');
    }
}
