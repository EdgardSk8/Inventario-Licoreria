<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {

        $this->call([
            rolesSeeder::class,
            permisosSeeder::class,
            rol_permisoSeeder::class,
            usuariosSeeder::class,
            categoriaSeeder::class,
            impuestosSeeder::class,
            metodos_pagoSeeder::class,
            tipo_gastoSeeder::class,
            proveedoresSeeder::class,
            clientesSeeder::class,
            cajasSeeder::class,
            productosSeeder::class,
            movimientos_inventarioSeeder::class,
            comprasSeeder::class,
            detalle_comprasSeeder::class,
            ventasSeeder::class,
            detalle_ventasSeeder::class,
            movimientos_cajaSeeder::class,
            gastosSeeder::class,
        ]);
    }
}
