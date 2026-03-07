<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detalle_ventasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('detalle_ventas')->insert([

            ['id_venta'=>1,'id_producto'=>1,'cantidad_venta'=>2,'precio_unitario_venta'=>18,'subtotal_detalle_venta'=>36],
            ['id_venta'=>1,'id_producto'=>3,'cantidad_venta'=>1,'precio_unitario_venta'=>15,'subtotal_detalle_venta'=>15],

            ['id_venta'=>2,'id_producto'=>2,'cantidad_venta'=>3,'precio_unitario_venta'=>20,'subtotal_detalle_venta'=>60],

            ['id_venta'=>3,'id_producto'=>4,'cantidad_venta'=>2,'precio_unitario_venta'=>16,'subtotal_detalle_venta'=>32],
            ['id_venta'=>3,'id_producto'=>5,'cantidad_venta'=>1,'precio_unitario_venta'=>19,'subtotal_detalle_venta'=>19],

            ['id_venta'=>4,'id_producto'=>6,'cantidad_venta'=>2,'precio_unitario_venta'=>14,'subtotal_detalle_venta'=>28],
            ['id_venta'=>4,'id_producto'=>7,'cantidad_venta'=>1,'precio_unitario_venta'=>22,'subtotal_detalle_venta'=>22],

            ['id_venta'=>5,'id_producto'=>8,'cantidad_venta'=>2,'precio_unitario_venta'=>25,'subtotal_detalle_venta'=>50],

            ['id_venta'=>6,'id_producto'=>1,'cantidad_venta'=>1,'precio_unitario_venta'=>18,'subtotal_detalle_venta'=>18],
            ['id_venta'=>6,'id_producto'=>2,'cantidad_venta'=>1,'precio_unitario_venta'=>20,'subtotal_detalle_venta'=>20],

            ['id_venta'=>7,'id_producto'=>3,'cantidad_venta'=>2,'precio_unitario_venta'=>15,'subtotal_detalle_venta'=>30],
            ['id_venta'=>7,'id_producto'=>4,'cantidad_venta'=>1,'precio_unitario_venta'=>16,'subtotal_detalle_venta'=>16],

            ['id_venta'=>8,'id_producto'=>5,'cantidad_venta'=>2,'precio_unitario_venta'=>19,'subtotal_detalle_venta'=>38],

            ['id_venta'=>9,'id_producto'=>6,'cantidad_venta'=>1,'precio_unitario_venta'=>14,'subtotal_detalle_venta'=>14],
            ['id_venta'=>9,'id_producto'=>7,'cantidad_venta'=>1,'precio_unitario_venta'=>22,'subtotal_detalle_venta'=>22],

            ['id_venta'=>10,'id_producto'=>8,'cantidad_venta'=>3,'precio_unitario_venta'=>25,'subtotal_detalle_venta'=>75]

        ]);
    }
}
