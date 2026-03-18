<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class gastosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gastos')->insert([

             [
                'id_tipo_gasto' => 1,
                'descripcion_gasto' => 'Pago de electricidad del mes',
                'monto_gasto' => 120.50,
                'fecha_gasto' => now(),
                'id_usuario' => 1,
                'id_caja' => 1,
                'id_cuenta' => null
            ],

            [
                'id_tipo_gasto' => 2,
                'descripcion_gasto' => 'Limpieza general del local',
                'monto_gasto' => 75.00,
                'fecha_gasto' => now(),
                'id_usuario' => 1,
                'id_caja' => 1,
                'id_cuenta' => null
            ],

            [
                'id_tipo_gasto' => 3,
                'descripcion_gasto' => 'Pago de salario empleado',
                'monto_gasto' => 500.00,
                'fecha_gasto' => now(),
                'id_usuario' => 1,
                'id_caja' => null,      // 👇 ahora viene de banco
                'id_cuenta' => 1
            ],

            [
                'id_tipo_gasto' => 4,
                'descripcion_gasto' => 'Pago de impuesto municipal',
                'monto_gasto' => 80.75,
                'fecha_gasto' => now(),
                'id_usuario' => 1,
                'id_caja' => null,
                'id_cuenta' => 2
            ],

            [
                'id_tipo_gasto' => 5,
                'descripcion_gasto' => 'Compra de útiles de oficina',
                'monto_gasto' => 45.00,
                'fecha_gasto' => now(),
                'id_usuario' => 1,
                'id_caja' => 1,
                'id_cuenta' => null
            ],

        ]);
    }
}
