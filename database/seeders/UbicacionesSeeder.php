<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('ubicaciones')->insert([

            [
                'nombre_ubicacion' => 'Estante A',
                'descripcion_ubicacion' => 'Estante principal de licores',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Estante B',
                'descripcion_ubicacion' => 'Estante secundario',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Ropero 1',
                'descripcion_ubicacion' => 'Área de almacenamiento cerrado',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Bodega',
                'descripcion_ubicacion' => 'Almacenamiento general',
                'estado_ubicacion' => 1
            ]

        ]);
    }
}
