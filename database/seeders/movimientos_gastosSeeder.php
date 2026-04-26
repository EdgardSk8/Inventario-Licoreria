<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class movimientos_gastosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movimientos_gastos')->insert([

            [
                'id_gasto' => 1, // Luz
                'monto' => 120.50,
                'origen' => 'CAJA',
                'id_caja' => 1,
                'id_cuenta' => null,
                'fecha' => now(),
                'id_usuario' => 1,
                'observacion' => 'Pago de electricidad enero'
            ],

            [
                'id_gasto' => 1, // Luz otra vez (historial)
                'monto' => 130.00,
                'origen' => 'CUENTA',
                'id_caja' => null,
                'id_cuenta' => 1,
                'fecha' => now()->subMonth(),
                'id_usuario' => 1,
                'observacion' => 'Pago electricidad diciembre'
            ],

            [
                'id_gasto' => 2, // Mantenimiento
                'monto' => 75.00,
                'origen' => 'CAJA',
                'id_caja' => 1,
                'id_cuenta' => null,
                'fecha' => now(),
                'id_usuario' => 1,
                'observacion' => 'Limpieza del local'
            ],

            [
                'id_gasto' => 3, // Sueldo
                'monto' => 500.00,
                'origen' => 'CUENTA',
                'id_caja' => null,
                'id_cuenta' => 1,
                'fecha' => now(),
                'id_usuario' => 1,
                'observacion' => 'Pago salario mensual'
            ],

            [
                'id_gasto' => 4, // Impuesto
                'monto' => 80.75,
                'origen' => 'CUENTA',
                'id_caja' => null,
                'id_cuenta' => 2,
                'fecha' => now(),
                'id_usuario' => 1,
                'observacion' => 'Pago impuesto municipal'
            ],

        ]);
    }

}
