<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productosSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([

            // 🍺 RONES (alta rotación)
            ['nombre_producto'=>'Flor de Caña 4 años','descripcion_producto'=>'Ron joven 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>420.00,'precio_venta'=>550.00,'stock_actual'=>80,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Flor de Caña 7 años','descripcion_producto'=>'Ron añejo 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>650.00,'precio_venta'=>850.00,'stock_actual'=>50,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Flor de Caña 12 años','descripcion_producto'=>'Ron premium','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>1200.00,'precio_venta'=>1500.00,'stock_actual'=>40,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Bacardi Blanco','descripcion_producto'=>'Ron blanco 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>500.00,'precio_venta'=>650.00,'stock_actual'=>60,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Ron Centenario 7','descripcion_producto'=>'Ron costarricense','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>700.00,'precio_venta'=>900.00,'stock_actual'=>35,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            // 🍻 CERVEZAS
            ['nombre_producto'=>'Toña','descripcion_producto'=>'Cerveza nacional','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>26.00,'precio_venta'=>33.00,'stock_actual'=>220,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Victoria Clásica','descripcion_producto'=>'Cerveza nacional','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>25.00,'precio_venta'=>32.00,'stock_actual'=>200,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Heineken','descripcion_producto'=>'Importada','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>45.00,'precio_venta'=>60.00,'stock_actual'=>120,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Corona Extra','descripcion_producto'=>'Importada mexicana','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>50.00,'precio_venta'=>65.00,'stock_actual'=>110,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Modelo Especial','descripcion_producto'=>'Cerveza premium','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>55.00,'precio_venta'=>70.00,'stock_actual'=>90,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            // 🥤 REFRESCOS
            ['nombre_producto'=>'Coca Cola 600ml','descripcion_producto'=>'Gaseosa','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>18.00,'precio_venta'=>25.00,'stock_actual'=>150,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Pepsi 600ml','descripcion_producto'=>'Gaseosa','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>18.00,'precio_venta'=>25.00,'stock_actual'=>140,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Fanta Naranja','descripcion_producto'=>'Refresco','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>17.00,'precio_venta'=>24.00,'stock_actual'=>130,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Sprite 600ml','descripcion_producto'=>'Refresco','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>17.00,'precio_venta'=>24.00,'stock_actual'=>120,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Agua 600ml','descripcion_producto'=>'Agua purificada','id_categoria'=>3,'id_impuesto'=>3,'precio_compra'=>10.00,'precio_venta'=>18.00,'stock_actual'=>200,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            // 🍫 SNACKS
            ['nombre_producto'=>'Papas Lays','descripcion_producto'=>'Snack','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>25.00,'precio_venta'=>35.00,'stock_actual'=>80,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Pringles','descripcion_producto'=>'Snack importado','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>70.00,'precio_venta'=>95.00,'stock_actual'=>60,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Oreo','descripcion_producto'=>'Galletas','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>30.00,'precio_venta'=>42.00,'stock_actual'=>90,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Snickers','descripcion_producto'=>'Chocolate','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>22.00,'precio_venta'=>30.00,'stock_actual'=>100,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'KitKat','descripcion_producto'=>'Chocolate','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>23.00,'precio_venta'=>31.00,'stock_actual'=>0,'estado_producto'=>false,'fecha_creacion_producto'=>now()],
        ]);
    }
}