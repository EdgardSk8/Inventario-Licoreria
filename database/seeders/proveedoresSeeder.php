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
        'nombre_proveedor'=>'Distribuidora Flor de Caña',
        'telefono_proveedor'=>'88887777',
        'direccion_proveedor'=>'Managua'
        ],

        [
        'nombre_proveedor'=>'Licores Centroamericanos',
        'telefono_proveedor'=>'88886666',
        'direccion_proveedor'=>'León'
        ],

        [
        'nombre_proveedor'=>'Importadora Premium',
        'telefono_proveedor'=>'88885555',
        'direccion_proveedor'=>'Managua'
        ]

        ]);
    }
}
