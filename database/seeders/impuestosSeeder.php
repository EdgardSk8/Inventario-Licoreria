<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class impuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('impuestos')->insert([
            [
                'nombre_impuesto' => 'IVA',
                'porcentaje_impuesto' => 15.00,
                'estado_impuesto' => true,
                'fecha_creacion_impuesto' => now()
            ],
            [
                'nombre_impuesto' => 'ISC Bebidas',
                'porcentaje_impuesto' => 10.00,
                'estado_impuesto' => true,
                'fecha_creacion_impuesto' => now()
            ],
            [
                'nombre_impuesto' => 'Exento',
                'porcentaje_impuesto' => 0.00,
                'estado_impuesto' => true,
                'fecha_creacion_impuesto' => now()
            ]
        ]);
    }
}
