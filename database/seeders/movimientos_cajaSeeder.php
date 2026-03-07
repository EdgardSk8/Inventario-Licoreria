<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class movimientos_cajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movimientos_caja')->insert([
            
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Apertura de caja',
                'monto_movimiento_caja' => 2000.00,
                'fecha_movimiento_caja' => now(),
                'id_usuario' => 1,
                'id_referencia' => null
            ],

            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Venta mostrador',
                'monto_movimiento_caja' => 350.50,
                'fecha_movimiento_caja' => now(),
                'id_usuario' => 1,
                'id_referencia' => 1
            ],

            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Pago de proveedor',
                'monto_movimiento_caja' => 500.00,
                'fecha_movimiento_caja' => now(),
                'id_usuario' => 1,
                'id_referencia' => 2
            ],

            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Gasto operativo',
                'monto_movimiento_caja' => 120.75,
                'fecha_movimiento_caja' => now(),
                'id_usuario' => 1,
                'id_referencia' => null
            ],

        ]);
    }
}
