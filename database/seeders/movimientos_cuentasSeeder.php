<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class movimientos_cuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                DB::table('movimientos_cuentas')->insert([

            [
                'id_cuenta' => 1,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 5000.00,
                'descripcion' => 'Saldo inicial cuenta',
                'fecha' => now(),
                'id_usuario' => 1
            ],

            [
                'id_cuenta' => 1,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 1200.00,
                'descripcion' => 'Transferencia desde caja',
                'fecha' => now(),
                'id_usuario' => 1
            ],

            [
                'id_cuenta' => 1,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 500.00,
                'descripcion' => 'Pago de proveedor',
                'fecha' => now(),
                'id_usuario' => 1
            ],

            [
                'id_cuenta' => 2,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 3200.50,
                'descripcion' => 'Depósito inicial',
                'fecha' => now(),
                'id_usuario' => 1
            ],

            [
                'id_cuenta' => 2,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 300.00,
                'descripcion' => 'Pago de servicios',
                'fecha' => now(),
                'id_usuario' => 1
            ],

            [
                'id_cuenta' => 3,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 10000.00,
                'descripcion' => 'Fondo de ahorro inicial',
                'fecha' => now(),
                'id_usuario' => 1
            ],

            [
                'id_cuenta' => 3,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 1500.00,
                'descripcion' => 'Uso de ahorro para inversión',
                'fecha' => now(),
                'id_usuario' => 1
            ]

        ]);
    }
}
