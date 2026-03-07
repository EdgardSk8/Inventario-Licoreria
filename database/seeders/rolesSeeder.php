<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['nombre_rol' => 'Administrador'],
            ['nombre_rol' => 'Cajero'],
            ['nombre_rol' => 'Bodeguero']
        ]);

    }
}
