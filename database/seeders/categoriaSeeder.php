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
                'nombre_categoria' => 'Tequila',
                'descripcion_categoria' => 'Destilado elaborado a base de agave',
                'estado_categoria' => 1
            ],

            [
                'nombre_categoria' => 'Ginebra',
                'descripcion_categoria' => 'Licor aromatizado principalmente con enebro',
                'estado_categoria' => 1
            ],

            [
                'nombre_categoria' => 'Vinos',
                'descripcion_categoria' => 'Bebidas fermentadas elaboradas con uvas',
                'estado_categoria' => 1
            ],

            [
                'nombre_categoria' => 'Champagne y Espumantes',
                'descripcion_categoria' => 'Vinos espumosos para celebraciones y eventos',
                'estado_categoria' => 1
            ],

            [
                'nombre_categoria' => 'Licores y Cremas',
                'descripcion_categoria' => 'Licores dulces, cremas y bebidas saborizadas',
                'estado_categoria' => 1
            ],

            [
                'nombre_categoria' => 'Energéticas',
                'descripcion_categoria' => 'Bebidas energizantes y estimulantes',
                'estado_categoria' => 1
            ],

            [
                'nombre_categoria' => 'Refrescos',
                'descripcion_categoria' => 'Bebidas gaseosas y refrescantes sin alcohol',
                'estado_categoria' => 1
            ],

            [
                'nombre_categoria' => 'Agua y Soda',
                'descripcion_categoria' => 'Agua purificada, mineral y sodas',
                'estado_categoria' => 1
            ],

        ]);
    }
}