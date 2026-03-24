<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class clientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            
        ['nombre_cliente'=>'Cliente Generico','telefono_cliente'=>''],
        ['nombre_cliente'=>'Maria Lopez','telefono_cliente'=>'88880002'],
        ['nombre_cliente'=>'Carlos Martinez','telefono_cliente'=>'88880003'],
        ['nombre_cliente'=>'Ana Rodriguez','telefono_cliente'=>'88880004'],
        ['nombre_cliente'=>'Luis Garcia','telefono_cliente'=>'88880005'],
        ['nombre_cliente'=>'Pedro Sanchez','telefono_cliente'=>'88880006'],
        ['nombre_cliente'=>'Daniel Torres','telefono_cliente'=>'88880007'],
        ['nombre_cliente'=>'Jorge Mendoza','telefono_cliente'=>'88880008'],
        ['nombre_cliente'=>'Jose Castillo','telefono_cliente'=>'88880009'],
        ['nombre_cliente'=>'Miguel Vargas','telefono_cliente'=>'88880010'],
        ['nombre_cliente'=>'Andrea Ruiz','telefono_cliente'=>'88880011'],
        ['nombre_cliente'=>'Claudia Flores','telefono_cliente'=>'88880012'],
        ['nombre_cliente'=>'Mario Chavez','telefono_cliente'=>'88880013'],
        ['nombre_cliente'=>'Rosa Herrera','telefono_cliente'=>'88880014'],
        ['nombre_cliente'=>'Elena Morales','telefono_cliente'=>'88880015'],
        ['nombre_cliente'=>'Oscar Duarte','telefono_cliente'=>'88880016'],
        ['nombre_cliente'=>'Ricardo Vega','telefono_cliente'=>'88880017'],
        ['nombre_cliente'=>'Patricia Diaz','telefono_cliente'=>'88880018'],
        ['nombre_cliente'=>'Eduardo Rivas','telefono_cliente'=>'88880019'],
        ['nombre_cliente'=>'Fernando Ramos','telefono_cliente'=>'88880020']
        

        ]);
    }
}
