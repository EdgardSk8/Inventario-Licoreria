<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ubicaciones')->insert([

            [
                'nombre_ubicacion' => 'Estante A - Licores Premium',
                'descripcion_ubicacion' => 'Whisky, ron añejo y productos de alto valor',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Estante B - Licores Comerciales',
                'descripcion_ubicacion' => 'Ron, vodka y productos de consumo regular',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Estante C - Cervezas',
                'descripcion_ubicacion' => 'Cervezas nacionales e importadas',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Estante D - Refrescos',
                'descripcion_ubicacion' => 'Bebidas gaseosas y aguas',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Estante E - Snacks',
                'descripcion_ubicacion' => 'Papas, dulces y acompañantes',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Mostrador Principal',
                'descripcion_ubicacion' => 'Productos de alta rotación en venta directa',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Bodega General',
                'descripcion_ubicacion' => 'Almacenamiento principal de inventario',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Bodega Fría',
                'descripcion_ubicacion' => 'Productos que requieren refrigeración',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Zona Recepción',
                'descripcion_ubicacion' => 'Entrada de mercadería y revisión de compras',
                'estado_ubicacion' => 1
            ],

            [
                'nombre_ubicacion' => 'Estante Promociones',
                'descripcion_ubicacion' => 'Productos en oferta o liquidación',
                'estado_ubicacion' => 1
            ],

        ]);
    }
}