<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('categoria')->insert([
            [
                'nombre_categoria' => 'Ron',
                'descripcion_categoria' => 'Bebidas destiladas a base de caña de azúcar',
                'estado_categoria' => 1
            ],
            [
                'nombre_categoria' => 'Whisky',
                'descripcion_categoria' => 'Destilado de granos envejecido en barrica',
                'estado_categoria' => 1
            ],
            [
                'nombre_categoria' => 'Vodka',
                'descripcion_categoria' => 'Bebida neutra de alta graduación alcohólica',
                'estado_categoria' => 1
            ],
            [
                'nombre_categoria' => 'Cervezas',
                'descripcion_categoria' => 'Bebidas fermentadas de malta y lúpulo',
                'estado_categoria' => 1
            ],
            [
                'nombre_categoria' => 'Licores y Cremas',
                'descripcion_categoria' => 'Licores dulces, cremas y bebidas saborizadas',
                'estado_categoria' => 1
            ],
        ]);
    }
}