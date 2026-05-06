<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class proveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedores')->insert([

            [
                'nombre_proveedor' => 'Distribuidora Flor de Caña',
                'telefono_proveedor' => '88887777',
                'direccion_proveedor' => 'Managua'
            ],
            [
                'nombre_proveedor' => 'Licores Centroamericanos S.A.',
                'telefono_proveedor' => '88886666',
                'direccion_proveedor' => 'León'
            ],
            [
                'nombre_proveedor' => 'Importadora Premium Drinks',
                'telefono_proveedor' => '88885555',
                'direccion_proveedor' => 'Managua'
            ],
            [
                'nombre_proveedor' => 'Distribuidora La Universal',
                'telefono_proveedor' => '88884444',
                'direccion_proveedor' => 'Masaya'
            ],
            [
                'nombre_proveedor' => 'Bebidas del Caribe Nicaragua',
                'telefono_proveedor' => '88883333',
                'direccion_proveedor' => 'Managua'
            ],
            [
                'nombre_proveedor' => 'Comercial La Esquina',
                'telefono_proveedor' => '88882222',
                'direccion_proveedor' => 'Chinandega'
            ],
            [
                'nombre_proveedor' => 'Distribuidora El Buen Trago',
                'telefono_proveedor' => '88881111',
                'direccion_proveedor' => 'León'
            ],
            [
                'nombre_proveedor' => 'Importadora Centroamericana de Licores',
                'telefono_proveedor' => '88880001',
                'direccion_proveedor' => 'Managua'
            ],
            [
                'nombre_proveedor' => 'Distribuidora Los Andes',
                'telefono_proveedor' => '88880002',
                'direccion_proveedor' => 'Estelí'
            ],
            [
                'nombre_proveedor' => 'Suministros y Bebidas Vega',
                'telefono_proveedor' => '88880003',
                'direccion_proveedor' => 'Granada'
            ],

        ]);
    }
}