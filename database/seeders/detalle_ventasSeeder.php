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

            ['id_venta'=>1,'id_producto'=>1,'cantidad_venta'=>2,'precio_unitario_venta'=>18,'subtotal_detalle_venta'=>36,'porcentaje_impuesto'=>10,'monto_impuesto'=>3.6],
            ['id_venta'=>1,'id_producto'=>3,'cantidad_venta'=>1,'precio_unitario_venta'=>15,'subtotal_detalle_venta'=>15,'porcentaje_impuesto'=>15,'monto_impuesto'=>2.25],

            ['id_venta'=>2,'id_producto'=>2,'cantidad_venta'=>3,'precio_unitario_venta'=>20,'subtotal_detalle_venta'=>60,'porcentaje_impuesto'=>10,'monto_impuesto'=>6],

            ['id_venta'=>3,'id_producto'=>4,'cantidad_venta'=>2,'precio_unitario_venta'=>16,'subtotal_detalle_venta'=>32,'porcentaje_impuesto'=>15,'monto_impuesto'=>4.8],
            ['id_venta'=>3,'id_producto'=>5,'cantidad_venta'=>1,'precio_unitario_venta'=>19,'subtotal_detalle_venta'=>19,'porcentaje_impuesto'=>10,'monto_impuesto'=>1.9],

            ['id_venta'=>4,'id_producto'=>6,'cantidad_venta'=>2,'precio_unitario_venta'=>14,'subtotal_detalle_venta'=>28,'porcentaje_impuesto'=>15,'monto_impuesto'=>4.2],
            ['id_venta'=>4,'id_producto'=>7,'cantidad_venta'=>1,'precio_unitario_venta'=>22,'subtotal_detalle_venta'=>22,'porcentaje_impuesto'=>10,'monto_impuesto'=>2.2],

            ['id_venta'=>5,'id_producto'=>8,'cantidad_venta'=>2,'precio_unitario_venta'=>25,'subtotal_detalle_venta'=>50,'porcentaje_impuesto'=>15,'monto_impuesto'=>7.5],

            ['id_venta'=>6,'id_producto'=>1,'cantidad_venta'=>1,'precio_unitario_venta'=>18,'subtotal_detalle_venta'=>18,'porcentaje_impuesto'=>10,'monto_impuesto'=>1.8],
            ['id_venta'=>6,'id_producto'=>2,'cantidad_venta'=>1,'precio_unitario_venta'=>20,'subtotal_detalle_venta'=>20,'porcentaje_impuesto'=>10,'monto_impuesto'=>2],

            ['id_venta'=>7,'id_producto'=>3,'cantidad_venta'=>2,'precio_unitario_venta'=>15,'subtotal_detalle_venta'=>30,'porcentaje_impuesto'=>15,'monto_impuesto'=>4.5],
            ['id_venta'=>7,'id_producto'=>4,'cantidad_venta'=>1,'precio_unitario_venta'=>16,'subtotal_detalle_venta'=>16,'porcentaje_impuesto'=>15,'monto_impuesto'=>2.4],

            ['id_venta'=>8,'id_producto'=>5,'cantidad_venta'=>2,'precio_unitario_venta'=>19,'subtotal_detalle_venta'=>38,'porcentaje_impuesto'=>10,'monto_impuesto'=>3.8],

            ['id_venta'=>9,'id_producto'=>6,'cantidad_venta'=>1,'precio_unitario_venta'=>14,'subtotal_detalle_venta'=>14,'porcentaje_impuesto'=>15,'monto_impuesto'=>2.1],
            ['id_venta'=>9,'id_producto'=>7,'cantidad_venta'=>1,'precio_unitario_venta'=>22,'subtotal_detalle_venta'=>22,'porcentaje_impuesto'=>10,'monto_impuesto'=>2.2],

            ['id_venta'=>10,'id_producto'=>8,'cantidad_venta'=>3,'precio_unitario_venta'=>25,'subtotal_detalle_venta'=>75,'porcentaje_impuesto'=>15,'monto_impuesto'=>11.25]


        ]);
    }
}
