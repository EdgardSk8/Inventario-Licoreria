<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([

            // 🍺 Licores
            ['nombre_producto'=>'Flor de Caña 7 años','descripcion_producto'=>'Ron añejo 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>650.00,'precio_venta'=>850.00,'stock_actual'=>50,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Flor de Caña 12 años','descripcion_producto'=>'Ron premium 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>1200.00,'precio_venta'=>1500.00,'stock_actual'=>40,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Flor de Caña 18 años','descripcion_producto'=>'Ron ultra premium 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>2000.00,'precio_venta'=>2500.00,'stock_actual'=>30,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Bacardi Blanco','descripcion_producto'=>'Ron blanco 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>500.00,'precio_venta'=>650.00,'stock_actual'=>60,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Ron Abuelo 7 años','descripcion_producto'=>'Ron añejo 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>800.00,'precio_venta'=>1000.00,'stock_actual'=>35,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            // 🍻 Cervezas
            ['nombre_producto'=>'Victoria Clásica','descripcion_producto'=>'Cerveza nacional 355ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>25.00,'precio_venta'=>32.00,'stock_actual'=>200,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Toña','descripcion_producto'=>'Cerveza nacional 355ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>26.00,'precio_venta'=>33.00,'stock_actual'=>220,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Heineken','descripcion_producto'=>'Cerveza importada 330ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>45.00,'precio_venta'=>60.00,'stock_actual'=>120,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Corona Extra','descripcion_producto'=>'Cerveza importada 355ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>50.00,'precio_venta'=>65.00,'stock_actual'=>110,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Modelo Especial','descripcion_producto'=>'Cerveza mexicana 355ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>55.00,'precio_venta'=>70.00,'stock_actual'=>90,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            // 🥤 Refrescos
            ['nombre_producto'=>'Coca Cola 600ml','descripcion_producto'=>'Refresco gaseoso','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>18.00,'precio_venta'=>25.00,'stock_actual'=>150,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Pepsi 600ml','descripcion_producto'=>'Refresco gaseoso','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>18.00,'precio_venta'=>25.00,'stock_actual'=>140,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Fanta Naranja','descripcion_producto'=>'Refresco sabor naranja','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>17.00,'precio_venta'=>24.00,'stock_actual'=>130,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Sprite 600ml','descripcion_producto'=>'Refresco sabor limón','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>17.00,'precio_venta'=>24.00,'stock_actual'=>120,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Agua Purificada 600ml','descripcion_producto'=>'Agua embotellada','id_categoria'=>3,'id_impuesto'=>3,'precio_compra'=>10.00,'precio_venta'=>18.00,'stock_actual'=>200,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            // 🍫 Snacks
            ['nombre_producto'=>'Papas Lays Clásicas','descripcion_producto'=>'Papas fritas','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>25.00,'precio_venta'=>35.00,'stock_actual'=>80,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Papas Pringles','descripcion_producto'=>'Papas fritas importadas','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>70.00,'precio_venta'=>95.00,'stock_actual'=>60,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Galletas Oreo','descripcion_producto'=>'Galletas rellenas','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>30.00,'precio_venta'=>42.00,'stock_actual'=>90,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Chocolate Snickers','descripcion_producto'=>'Barra de chocolate','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>22.00,'precio_venta'=>30.00,'stock_actual'=>100,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Chocolate KitKat','descripcion_producto'=>'Barra de chocolate','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>23.00,'precio_venta'=>31.00,'stock_actual'=>100,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
        ]);
    }
}
