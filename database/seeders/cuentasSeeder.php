<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cuentas')->insert([

            [
                'nombre_cuenta' => 'Caja General',
                'tipo_cuenta' => 'EFECTIVO',
                'descripcion' => 'Caja principal del negocio',
                'saldo_actual' => 2000.00,
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Banco BAC',
                'tipo_cuenta' => 'BANCARIA',
                'descripcion' => 'Cuenta bancaria principal',
                'saldo_actual' => 5000.00,
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Banco Lafise',
                'tipo_cuenta' => 'BANCARIA',
                'descripcion' => 'Cuenta secundaria',
                'saldo_actual' => 3200.50,
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Cuenta de Ahorro',
                'tipo_cuenta' => 'AHORRO',
                'descripcion' => 'Fondo de ahorro del negocio',
                'saldo_actual' => 10000.00,
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nombre_cuenta' => 'Cuenta Inactiva',
                'tipo_cuenta' => 'BANCARIA',
                'descripcion' => 'Cuenta no utilizada',
                'saldo_actual' => 0.00,
                'estado' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
