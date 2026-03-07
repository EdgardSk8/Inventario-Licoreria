<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'nombre_completo_usuario' => 'Administrador del Sistema',
                'cedula_identidad_usuario' => '000-000000-0000A',
                'nombre_usuario' => 'admin',
                'password_hash_usuario' => Hash::make('123456'),
                'id_rol_usuario' => 1,
                'estado_usuario' => true,
                'fecha_creacion_usuario' => now()
            ],
            [
            'nombre_completo_usuario' => 'Cajero',
            'cedula_identidad_usuario' => '000-000000-0000B',
            'nombre_usuario' => 'cajero',
            'password_hash_usuario' => Hash::make('123456'),
            'id_rol_usuario' => 2,
            'estado_usuario' => true,
            'fecha_creacion_usuario' => now()
            ]
        ]);
    }
}
