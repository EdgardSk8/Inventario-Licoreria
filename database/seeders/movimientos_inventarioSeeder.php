<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class movimientos_inventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('movimientos_inventario')->insert([

            [
                'id_producto' => 1,
                'tipo_movimiento' => 'ENTRADA',
                'cantidad_movimiento' => 50,
                'motivo_movimiento' => 'Compra inicial',
                'id_referencia' => null,
                'fecha_movimiento' => now(),
                'id_usuario' => 1
            ],

            [
                'id_producto' => 1,
                'tipo_movimiento' => 'SALIDA',
                'cantidad_movimiento' => 5,
                'motivo_movimiento' => 'Venta mostrador',
                'id_referencia' => 1,
                'fecha_movimiento' => now(),
                'id_usuario' => 1
            ],

            [
                'id_producto' => 2,
                'tipo_movimiento' => 'ENTRADA',
                'cantidad_movimiento' => 30,
                'motivo_movimiento' => 'Compra inicial',
                'id_referencia' => null,
                'fecha_movimiento' => now(),
                'id_usuario' => 1
            ],

            [
                'id_producto' => 2,
                'tipo_movimiento' => 'AJUSTE',
                'cantidad_movimiento' => -2,
                'motivo_movimiento' => 'Producto dañado',
                'id_referencia' => null,
                'fecha_movimiento' => now(),
                'id_usuario' => 1
            ],

        ]);
    }
}
