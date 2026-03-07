<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'cajas';
    protected $primaryKey = 'id_caja';
    public $timestamps = false;

    protected $fillable = [
        'fecha_apertura',
        'fecha_cierre',
        'monto_inicial',
        'monto_final',
        'estado_caja',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,'id_usuario');
    }
}
