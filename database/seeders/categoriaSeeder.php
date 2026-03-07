<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert([
        ['nombre_categoria'=>'Ron'],
        ['nombre_categoria'=>'Whisky'],
        ['nombre_categoria'=>'Vodka'],
        ['nombre_categoria'=>'Tequila'],
        ['nombre_categoria'=>'Cerveza'],
        ['nombre_categoria'=>'Ginebra'],
        ['nombre_categoria'=>'Licores dulces']

        ]);
    }
}
