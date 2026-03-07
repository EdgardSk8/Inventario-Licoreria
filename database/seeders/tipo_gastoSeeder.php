<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipo_gastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('tipo_gasto')->insert([
            [
                'nombre_tipo_gasto' => 'Servicios Públicos',
                'descripcion_tipo_gasto' => 'Pago de luz, agua, internet, teléfono',
                'estado_tipo_gasto' => true
            ],
            [
                'nombre_tipo_gasto' => 'Mantenimiento',
                'descripcion_tipo_gasto' => 'Reparaciones, limpieza y mantenimiento del local',
                'estado_tipo_gasto' => true
            ],
            [
                'nombre_tipo_gasto' => 'Sueldos',
                'descripcion_tipo_gasto' => 'Pago de salarios al personal',
                'estado_tipo_gasto' => true
            ],
            [
                'nombre_tipo_gasto' => 'Impuestos',
                'descripcion_tipo_gasto' => 'Pagos de impuestos locales y nacionales',
                'estado_tipo_gasto' => true
            ],
            [
                'nombre_tipo_gasto' => 'Otros',
                'descripcion_tipo_gasto' => 'Gastos varios no contemplados en otras categorías',
                'estado_tipo_gasto' => true
            ],
        ]);
    }
}
