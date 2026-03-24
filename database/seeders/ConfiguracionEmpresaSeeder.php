<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('configuracion_empresa')->insert([
            'nombre_empresa' => 'Tellez',
            'ruc_empresa' => 'J0310000000001', // inventado
            'direccion_empresa' => 'Barrio San Juan, León, Nicaragua',
            'telefono_empresa' => '8888-9999',
            'correo_empresa' => 'contacto@tellez.com',
            'logo_empresa' => null, // por ahora vacío
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
