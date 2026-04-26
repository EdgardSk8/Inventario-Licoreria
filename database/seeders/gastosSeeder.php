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
                'nombre_gasto' => 'Luz',
                'descripcion_gasto' => 'Pago de electricidad',
                'estado_gasto' => true
            ],

            [
                'id_tipo_gasto' => 1,
                'nombre_gasto' => 'Agua',
                'descripcion_gasto' => 'Pago de agua potable',
                'estado_gasto' => true
            ],

            [
                'id_tipo_gasto' => 1,
                'nombre_gasto' => 'Internet',
                'descripcion_gasto' => 'Pago de servicio de internet',
                'estado_gasto' => true
            ],

            [
                'id_tipo_gasto' => 3,
                'nombre_gasto' => 'Salarios',
                'descripcion_gasto' => 'Pago de empleados',
                'estado_gasto' => true
            ],

            [
                'id_tipo_gasto' => 4,
                'nombre_gasto' => 'Impuestos',
                'descripcion_gasto' => 'Pago de impuestos municipales',
                'estado_gasto' => true
            ],

        ]);
    }
    
}
