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

        ['nombre_producto'=>'Flor de Caña 7 años','descripcion_producto'=>'Ron añejo 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>18,'precio_venta'=>25,'stock_actual'=>50,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Flor de Caña 12 años','descripcion_producto'=>'Ron premium 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>35,'precio_venta'=>45,'stock_actual'=>40,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Flor de Caña 18 años','descripcion_producto'=>'Ron ultra premium 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>55,'precio_venta'=>70,'stock_actual'=>30,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Bacardi Blanco','descripcion_producto'=>'Ron blanco 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>14,'precio_venta'=>20,'stock_actual'=>60,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Ron Abuelo 7 años','descripcion_producto'=>'Ron añejo 750ml','id_categoria'=>1,'id_impuesto'=>2,'precio_compra'=>22,'precio_venta'=>30,'stock_actual'=>35,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            ['nombre_producto'=>'Victoria Clásica','descripcion_producto'=>'Cerveza nacional 355ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>0.70,'precio_venta'=>1.10,'stock_actual'=>200,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Toña','descripcion_producto'=>'Cerveza nacional 355ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>0.75,'precio_venta'=>1.20,'stock_actual'=>220,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Heineken','descripcion_producto'=>'Cerveza importada 330ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>1.20,'precio_venta'=>1.80,'stock_actual'=>120,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Corona Extra','descripcion_producto'=>'Cerveza importada 355ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>1.30,'precio_venta'=>2.00,'stock_actual'=>110,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Modelo Especial','descripcion_producto'=>'Cerveza mexicana 355ml','id_categoria'=>2,'id_impuesto'=>2,'precio_compra'=>1.40,'precio_venta'=>2.10,'stock_actual'=>90,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            ['nombre_producto'=>'Coca Cola 600ml','descripcion_producto'=>'Refresco gaseoso','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>0.50,'precio_venta'=>0.90,'stock_actual'=>150,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Pepsi 600ml','descripcion_producto'=>'Refresco gaseoso','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>0.50,'precio_venta'=>0.90,'stock_actual'=>140,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Fanta Naranja','descripcion_producto'=>'Refresco sabor naranja','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>0.45,'precio_venta'=>0.85,'stock_actual'=>130,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Sprite 600ml','descripcion_producto'=>'Refresco sabor limón','id_categoria'=>3,'id_impuesto'=>1,'precio_compra'=>0.45,'precio_venta'=>0.85,'stock_actual'=>120,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Agua Purificada 600ml','descripcion_producto'=>'Agua embotellada','id_categoria'=>3,'id_impuesto'=>3,'precio_compra'=>0.25,'precio_venta'=>0.60,'stock_actual'=>200,'estado_producto'=>true,'fecha_creacion_producto'=>now()],

            ['nombre_producto'=>'Papas Lays Clásicas','descripcion_producto'=>'Papas fritas','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>0.70,'precio_venta'=>1.20,'stock_actual'=>80,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Papas Pringles','descripcion_producto'=>'Papas fritas importadas','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>1.50,'precio_venta'=>2.50,'stock_actual'=>60,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Galletas Oreo','descripcion_producto'=>'Galletas rellenas','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>0.80,'precio_venta'=>1.40,'stock_actual'=>90,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Chocolate Snickers','descripcion_producto'=>'Barra de chocolate','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>0.60,'precio_venta'=>1.10,'stock_actual'=>100,'estado_producto'=>true,'fecha_creacion_producto'=>now()],
            ['nombre_producto'=>'Chocolate KitKat','descripcion_producto'=>'Barra de chocolate','id_categoria'=>4,'id_impuesto'=>1,'precio_compra'=>0.65,'precio_venta'=>1.15,'stock_actual'=>100,'estado_producto'=>true,'fecha_creacion_producto'=>now()]

        ]);
    }
}
