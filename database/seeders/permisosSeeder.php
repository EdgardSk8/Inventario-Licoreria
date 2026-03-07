<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permisos')->insert([

            // USUARIOS
            ['nombre_permiso'=>'ver_usuarios','descripcion_permiso'=>'Permite ver usuarios','modulo_permiso'=>'usuarios'],
            ['nombre_permiso'=>'crear_usuarios','descripcion_permiso'=>'Permite crear usuarios','modulo_permiso'=>'usuarios'],
            ['nombre_permiso'=>'editar_usuarios','descripcion_permiso'=>'Permite editar usuarios','modulo_permiso'=>'usuarios'],
            ['nombre_permiso'=>'eliminar_usuarios','descripcion_permiso'=>'Permite eliminar usuarios','modulo_permiso'=>'usuarios'],

            // ROLES
            ['nombre_permiso'=>'ver_roles','descripcion_permiso'=>'Permite ver roles','modulo_permiso'=>'roles'],
            ['nombre_permiso'=>'gestionar_roles_permisos','descripcion_permiso'=>'Permite asignar permisos a roles','modulo_permiso'=>'roles'],

            // PRODUCTOS
            ['nombre_permiso'=>'ver_productos','descripcion_permiso'=>'Permite ver productos','modulo_permiso'=>'productos'],
            ['nombre_permiso'=>'crear_productos','descripcion_permiso'=>'Permite crear productos','modulo_permiso'=>'productos'],
            ['nombre_permiso'=>'editar_productos','descripcion_permiso'=>'Permite editar productos','modulo_permiso'=>'productos'],
            ['nombre_permiso'=>'eliminar_productos','descripcion_permiso'=>'Permite eliminar productos','modulo_permiso'=>'productos'],

            // CATEGORIAS
            ['nombre_permiso'=>'ver_categorias','descripcion_permiso'=>'Permite ver categorias','modulo_permiso'=>'categorias'],
            ['nombre_permiso'=>'crear_categorias','descripcion_permiso'=>'Permite crear categorias','modulo_permiso'=>'categorias'],
            ['nombre_permiso'=>'editar_categorias','descripcion_permiso'=>'Permite editar categorias','modulo_permiso'=>'categorias'],
            ['nombre_permiso'=>'eliminar_categorias','descripcion_permiso'=>'Permite eliminar categorias','modulo_permiso'=>'categorias'],

            // PROVEEDORES
            ['nombre_permiso'=>'ver_proveedores','descripcion_permiso'=>'Permite ver proveedores','modulo_permiso'=>'proveedores'],
            ['nombre_permiso'=>'crear_proveedores','descripcion_permiso'=>'Permite crear proveedores','modulo_permiso'=>'proveedores'],
            ['nombre_permiso'=>'editar_proveedores','descripcion_permiso'=>'Permite editar proveedores','modulo_permiso'=>'proveedores'],

            // CLIENTES
            ['nombre_permiso'=>'ver_clientes','descripcion_permiso'=>'Permite ver clientes','modulo_permiso'=>'clientes'],
            ['nombre_permiso'=>'crear_clientes','descripcion_permiso'=>'Permite crear clientes','modulo_permiso'=>'clientes'],
            ['nombre_permiso'=>'editar_clientes','descripcion_permiso'=>'Permite editar clientes','modulo_permiso'=>'clientes'],

            // COMPRAS
            ['nombre_permiso'=>'ver_compras','descripcion_permiso'=>'Permite ver compras','modulo_permiso'=>'compras'],
            ['nombre_permiso'=>'registrar_compras','descripcion_permiso'=>'Permite registrar compras','modulo_permiso'=>'compras'],

            // VENTAS
            ['nombre_permiso'=>'ver_ventas','descripcion_permiso'=>'Permite ver ventas','modulo_permiso'=>'ventas'],
            ['nombre_permiso'=>'registrar_ventas','descripcion_permiso'=>'Permite registrar ventas','modulo_permiso'=>'ventas'],
            ['nombre_permiso'=>'imprimir_factura','descripcion_permiso'=>'Permite imprimir factura','modulo_permiso'=>'ventas'],

            // INVENTARIO
            ['nombre_permiso'=>'ver_inventario','descripcion_permiso'=>'Permite ver inventario','modulo_permiso'=>'inventario'],

            // REPORTES
            ['nombre_permiso'=>'ver_reportes','descripcion_permiso'=>'Permite ver reportes','modulo_permiso'=>'reportes'],
            ['nombre_permiso'=>'generar_reportes','descripcion_permiso'=>'Permite generar reportes parametrizados','modulo_permiso'=>'reportes'],
            ['nombre_permiso'=>'exportar_reportes','descripcion_permiso'=>'Permite exportar reportes a Excel o PDF','modulo_permiso'=>'reportes'],
            
            // SISTEMA
            ['nombre_permiso'=>'backup_base_datos','descripcion_permiso'=>'Permite realizar backup','modulo_permiso'=>'sistema'],

        ]);
    }
}
