<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rol_permisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesPermisos = [];

        /*
        ╔══════════════════════════════════════╗
        ║ ADMIN (ROL 1) → TODOS LOS PERMISOS ║
        ╚══════════════════════════════════════╝
        */

        $permisos = DB::table('permisos')->get();

        foreach ($permisos as $permiso) {

            $rolesPermisos[] = [
                'id_rol' => 1,
                'id_permiso' => $permiso->id_permiso,
                'fecha_asignacion_rol_permiso' => now()
            ];
        }

        /*
        ╔══════════════════════════════════════╗
        ║ CAJERO (ROL 2)                      ║
        ╚══════════════════════════════════════╝
        */

        $permisosCajero = [

            'dashboard.ver',

            'ventas.ver',
            'ventas.detalle',

            'facturacion.ver',
            'facturacion.facturar',

            'clientes.ver',
            'clientes.crear',

            'productos.ver',

            'cajas.ver',
            'cajas.abrir',
            'cajas.cerrar',
            'cajas.movimientos',

            'movimientos-caja.ver',

            'cuentas.ver',
            'cuentas.movimientos',
        ];

        foreach ($permisosCajero as $nombrePermiso) {

            $permiso = DB::table('permisos')
                ->where('nombre_permiso', $nombrePermiso)
                ->first();

            if ($permiso) {

                $rolesPermisos[] = [
                    'id_rol' => 2,
                    'id_permiso' => $permiso->id_permiso,
                    'fecha_asignacion_rol_permiso' => now()
                ];
            }
        }

        /*
        ╔══════════════════════════════════════╗
        ║ BODEGUERO (ROL 3)                   ║
        ╚══════════════════════════════════════╝
        */

        $permisosBodeguero = [

            'dashboard.ver',

            'productos.ver',
            'productos.crear',
            'productos.editar',

            'categorias.ver',

            'inventario.movimientos',

            'compras.ver',
            'compras.crear',
            'compras.detalle',

            'proveedores.ver',
            'proveedores.crear',
            'proveedores.editar',
        ];

        foreach ($permisosBodeguero as $nombrePermiso) {

            $permiso = DB::table('permisos')
                ->where('nombre_permiso', $nombrePermiso)
                ->first();

            if ($permiso) {

                $rolesPermisos[] = [
                    'id_rol' => 3,
                    'id_permiso' => $permiso->id_permiso,
                    'fecha_asignacion_rol_permiso' => now()
                ];
            }
        }

        DB::table('rol_permiso')->insert($rolesPermisos);
    }
}