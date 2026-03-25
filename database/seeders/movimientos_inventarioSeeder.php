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
                'stock_resultante' => 50,         // stock después de esta entrada
                'motivo_movimiento' => 'Compra inicial',
                'id_referencia' => null,
                'tipo_referencia' => 'COMPRA',    // de dónde viene
                'precio_unitario' => null,
                'fecha_movimiento' => now(),
                'id_usuario' => 1
            ],

            [
                'id_producto' => 1,
                'tipo_movimiento' => 'SALIDA',
                'cantidad_movimiento' => 5,
                'stock_resultante' => 45,         // 50 - 5
                'motivo_movimiento' => 'Venta mostrador',
                'id_referencia' => 1,
                'tipo_referencia' => 'VENTA',
                'precio_unitario' => 10,          // ejemplo, opcional
                'fecha_movimiento' => now(),
                'id_usuario' => 1
            ],

            [
                'id_producto' => 2,
                'tipo_movimiento' => 'ENTRADA',
                'cantidad_movimiento' => 30,
                'stock_resultante' => 30,
                'motivo_movimiento' => 'Compra inicial',
                'id_referencia' => null,
                'tipo_referencia' => 'COMPRA',
                'precio_unitario' => null,
                'fecha_movimiento' => now(),
                'id_usuario' => 1
            ],

            [
                'id_producto' => 2,
                'tipo_movimiento' => 'AJUSTE',
                'cantidad_movimiento' => 2,        // siempre positivo
                'stock_resultante' => 28,          // 30 - 2 (producto dañado)
                'motivo_movimiento' => 'Producto dañado',
                'id_referencia' => null,
                'tipo_referencia' => 'AJUSTE',
                'precio_unitario' => null,
                'fecha_movimiento' => now(),
                'id_usuario' => 1
            ],

        ]);
    }
}
