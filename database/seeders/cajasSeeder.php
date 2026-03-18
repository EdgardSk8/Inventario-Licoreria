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

                'estado_caja'    => false,
                'id_usuario'     => 1,
            ],
            [
                'fecha_apertura' => now(),
                'fecha_cierre'   => null,

                'monto_inicial'  => 200.00,
                'monto_teorico'  => null,
                'monto_real'     => null,
                'diferencia'     => null,
                'monto_final'    => null,

                'estado_caja'    => true,
                'id_usuario'     => 2,
            ],
            [
                'fecha_apertura' => '2024-05-19 09:15:00',
                'fecha_cierre'   => '2024-05-19 17:00:00',

                'monto_inicial'  => 100.00,
                'monto_teorico'  => 420.00,
                'monto_real'     => 410.00,
                'diferencia'     => -10.00,
                'monto_final'    => 420.00,

                'estado_caja'    => false,
                'id_usuario'     => 2,
            ]
        ]);
    }
}
