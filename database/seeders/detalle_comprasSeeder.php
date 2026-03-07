<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detalle_comprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalle_compras')->insert([

            ['id_compra'=>1,'id_producto'=>1,'cantidad_compra'=>10,'precio_unitario_compra'=>18,'subtotal_detalle_compra'=>180],
            ['id_compra'=>1,'id_producto'=>4,'cantidad_compra'=>5,'precio_unitario_compra'=>14,'subtotal_detalle_compra'=>70],

            ['id_compra'=>2,'id_producto'=>6,'cantidad_compra'=>50,'precio_unitario_compra'=>0.70,'subtotal_detalle_compra'=>35],
            ['id_compra'=>2,'id_producto'=>7,'cantidad_compra'=>50,'precio_unitario_compra'=>0.75,'subtotal_detalle_compra'=>37.5],

            ['id_compra'=>3,'id_producto'=>11,'cantidad_compra'=>30,'precio_unitario_compra'=>0.50,'subtotal_detalle_compra'=>15],
            ['id_compra'=>3,'id_producto'=>12,'cantidad_compra'=>30,'precio_unitario_compra'=>0.50,'subtotal_detalle_compra'=>15],

            ['id_compra'=>4,'id_producto'=>2,'cantidad_compra'=>8,'precio_unitario_compra'=>35,'subtotal_detalle_compra'=>280],
            ['id_compra'=>4,'id_producto'=>3,'cantidad_compra'=>5,'precio_unitario_compra'=>55,'subtotal_detalle_compra'=>275],

            ['id_compra'=>5,'id_producto'=>16,'cantidad_compra'=>20,'precio_unitario_compra'=>0.70,'subtotal_detalle_compra'=>14],
            ['id_compra'=>5,'id_producto'=>18,'cantidad_compra'=>15,'precio_unitario_compra'=>0.80,'subtotal_detalle_compra'=>12]

        ]);
    }
}
