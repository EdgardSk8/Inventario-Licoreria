<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rol_permisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('rol_permiso')->insert([

            [
                'id_rol' => 1,
                'id_permiso' => 1,
                'fecha_asignacion_rol_permiso' => now()
            ],

            [
                'id_rol' => 1,
                'id_permiso' => 2,
                'fecha_asignacion_rol_permiso' => now()
            ],

            [
                'id_rol' => 1,
                'id_permiso' => 3,
                'fecha_asignacion_rol_permiso' => now()
            ],

            [
                'id_rol' => 2,
                'id_permiso' => 1,
                'fecha_asignacion_rol_permiso' => now()
            ],

            [
                'id_rol' => 2,
                'id_permiso' => 2,
                'fecha_asignacion_rol_permiso' => now()
            ]

        ]);
    }
}
