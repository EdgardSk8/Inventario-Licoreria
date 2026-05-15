<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cajasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cajas')->insert([

            [
                'fecha_apertura' => '2024-05-20 08:00:00',
                'fecha_cierre'   => '2024-05-20 18:30:00',
                'monto_inicial'  => 150.00,
                'monto_teorico'  => 850.75,
                'monto_real'     => 850.75,
                'diferencia'     => 0.00,
                'monto_final'    => 850.75,
                'estado_caja'    => 0,
                'id_usuario'     => 1,
            ],

            [
                'fecha_apertura' => '2025-05-20 08:00:00',
                'fecha_cierre'   => '2025-05-20 18:30:00',
                'monto_inicial'  => 200.00,
                'monto_teorico'  => 450.00,
                'monto_real'     => 440.00,
                'diferencia'     => -10.00,
                'monto_final'    => 450.00,
                'estado_caja'    => 0,
                'id_usuario'     => 2,
            ],

            [
                'fecha_apertura' => '2026-05-19 09:15:00',
                'fecha_cierre'   => '2026-05-19 17:00:00',
                'monto_inicial'  => 100.00,
                'monto_teorico'  => 420.00,
                'monto_real'     => 410.00,
                'diferencia'     => -10.00,
                'monto_final'    => 420.00,
                'estado_caja'    => 0,
                'id_usuario'     => 2,
            ],
            [
                'fecha_apertura' => now()->subDays(2)->format('Y-m-d 08:00:00'),
                'fecha_cierre'   => now()->subDays(2)->format('Y-m-d 18:00:00'),
                'monto_inicial'  => 250.00,
                'monto_teorico'  => 980.00,
                'monto_real'     => 1000.00,
                'diferencia'     => 20.00,
                'monto_final'    => 980.00,
                'estado_caja'    => 0,
                'id_usuario'     => 3,
            ],

            [
                'fecha_apertura' => now()->subDays(3)->format('Y-m-d 08:00:00'),
                'fecha_cierre'   => now()->subDays(3)->format('Y-m-d 18:00:00'),
                'monto_inicial'  => 180.00,
                'monto_teorico'  => 760.00,
                'monto_real'     => 760.00,
                'diferencia'     => 0.00,
                'monto_final'    => 760.00,
                'estado_caja'    => 0,
                'id_usuario'     => 2,
            ],

            [
                'fecha_apertura' => now()->subDays(4)->format('Y-m-d 08:00:00'),
                'fecha_cierre'   => now()->subDays(4)->format('Y-m-d 17:45:00'),
                'monto_inicial'  => 220.00,
                'monto_teorico'  => 1100.00,
                'monto_real'     => 1085.00,
                'diferencia'     => -15.00,
                'monto_final'    => 1100.00,
                'estado_caja'    => 0,
                'id_usuario'     => 1,
            ],
        ]);
    }
}