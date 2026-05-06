<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cuentasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cuentas')->insert([

            [
                'nombre_cuenta' => 'Caja Principal',
                'tipo_cuenta' => 'EFECTIVO',
                'descripcion' => 'Caja diaria del punto de venta principal',
                'saldo_actual' => 1500.00,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Caja Secundaria',
                'tipo_cuenta' => 'EFECTIVO',
                'descripcion' => 'Caja de apoyo o segundo turno',
                'saldo_actual' => 800.00,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'BAC Credomatic',
                'tipo_cuenta' => 'BANCARIA',
                'descripcion' => 'Cuenta empresarial BAC principal',
                'saldo_actual' => 5200.75,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Banpro',
                'tipo_cuenta' => 'BANCARIA',
                'descripcion' => 'Cuenta para pagos de proveedores',
                'saldo_actual' => 3100.00,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Fondo de Ahorro',
                'tipo_cuenta' => 'AHORRO',
                'descripcion' => 'Reserva financiera del negocio',
                'saldo_actual' => 10000.00,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Caja Eventos / Fiestas',
                'tipo_cuenta' => 'EFECTIVO',
                'descripcion' => 'Caja usada para ventas de eventos o pedidos grandes',
                'saldo_actual' => 0.00,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Cuenta Inactiva (Antigua)',
                'tipo_cuenta' => 'BANCARIA',
                'descripcion' => 'Cuenta bancaria en desuso',
                'saldo_actual' => 0.00,
                'estado' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}