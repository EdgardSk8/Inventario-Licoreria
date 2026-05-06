<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detalle_comprasSeeder extends Seeder
{
    public function run()
    {
        DB::table('detalle_compras')->insert([

            /* =========================
             * COMPRA 1 - RONES
             * ========================= */
            ['id_compra'=>1,'id_producto'=>1,'cantidad_compra'=>10,'precio_unitario_compra'=>18.00,'subtotal_detalle_compra'=>180.00],
            ['id_compra'=>1,'id_producto'=>2,'cantidad_compra'=>8,'precio_unitario_compra'=>5.00,'subtotal_detalle_compra'=>90.00],
            ['id_compra'=>1,'id_producto'=>3,'cantidad_compra'=>6,'precio_unitario_compra'=>30.00,'subtotal_detalle_compra'=>180.00],
            ['id_compra'=>1,'id_producto'=>4,'cantidad_compra'=>5,'precio_unitario_compra'=>14.00,'subtotal_detalle_compra'=>70.00],
            ['id_compra'=>1,'id_producto'=>5,'cantidad_compra'=>12,'precio_unitario_compra'=>12.00,'subtotal_detalle_compra'=>144.00],

            /* =========================
             * COMPRA 2 - CERVEZAS
             * ========================= */
            ['id_compra'=>2,'id_producto'=>6,'cantidad_compra'=>50,'precio_unitario_compra'=>0.70,'subtotal_detalle_compra'=>35.00],
            ['id_compra'=>2,'id_producto'=>7,'cantidad_compra'=>50,'precio_unitario_compra'=>0.75,'subtotal_detalle_compra'=>37.50],
            ['id_compra'=>2,'id_producto'=>8,'cantidad_compra'=>40,'precio_unitario_compra'=>0.80,'subtotal_detalle_compra'=>32.00],
            ['id_compra'=>2,'id_producto'=>9,'cantidad_compra'=>30,'precio_unitario_compra'=>0.85,'subtotal_detalle_compra'=>5.50],
            ['id_compra'=>2,'id_producto'=>10,'cantidad_compra'=>60,'precio_unitario_compra'=>0.65,'subtotal_detalle_compra'=>39.00],

            /* =========================
             * COMPRA 3 - LICORES DULCES
             * ========================= */
            ['id_compra'=>3,'id_producto'=>11,'cantidad_compra'=>9,'precio_unitario_compra'=>2.50,'subtotal_detalle_compra'=>50.00],
            ['id_compra'=>3,'id_producto'=>12,'cantidad_compra'=>5,'precio_unitario_compra'=>3.00,'subtotal_detalle_compra'=>75.00],
            ['id_compra'=>3,'id_producto'=>13,'cantidad_compra'=>15,'precio_unitario_compra'=>4.00,'subtotal_detalle_compra'=>60.00],
            ['id_compra'=>3,'id_producto'=>14,'cantidad_compra'=>10,'precio_unitario_compra'=>5.50,'subtotal_detalle_compra'=>55.00],
            ['id_compra'=>3,'id_producto'=>15,'cantidad_compra'=>12,'precio_unitario_compra'=>6.00,'subtotal_detalle_compra'=>72.00],

            /* =========================
             * COMPRA 4 - WHISKY
             * ========================= */
            ['id_compra'=>4,'id_producto'=>16,'cantidad_compra'=>5,'precio_unitario_compra'=>35.00,'subtotal_detalle_compra'=>175.00],
            ['id_compra'=>4,'id_producto'=>17,'cantidad_compra'=>3,'precio_unitario_compra'=>60.00,'subtotal_detalle_compra'=>180.00],
            ['id_compra'=>4,'id_producto'=>18,'cantidad_compra'=>4,'precio_unitario_compra'=>45.00,'subtotal_detalle_compra'=>180.00],
            ['id_compra'=>4,'id_producto'=>19,'cantidad_compra'=>2,'precio_unitario_compra'=>80.00,'subtotal_detalle_compra'=>160.00],
            ['id_compra'=>4,'id_producto'=>9,'cantidad_compra'=>6,'precio_unitario_compra'=>5.00,'subtotal_detalle_compra'=>150.00],

            /* =========================
             * COMPRA 5 - VODKA
             * ========================= */
            ['id_compra'=>5,'id_producto'=>4,'cantidad_compra'=>10,'precio_unitario_compra'=>12.00,'subtotal_detalle_compra'=>19.00],
            ['id_compra'=>5,'id_producto'=>1,'cantidad_compra'=>8,'precio_unitario_compra'=>15.00,'subtotal_detalle_compra'=>19.00],
            ['id_compra'=>5,'id_producto'=>8,'cantidad_compra'=>6,'precio_unitario_compra'=>18.00,'subtotal_detalle_compra'=>108.00],
            ['id_compra'=>5,'id_producto'=>3,'cantidad_compra'=>5,'precio_unitario_compra'=>9.00,'subtotal_detalle_compra'=>100.00],
            ['id_compra'=>5,'id_producto'=>5,'cantidad_compra'=>4,'precio_unitario_compra'=>1.00,'subtotal_detalle_compra'=>88.00],

            /* =========================
             * COMPRA 6 - MEZCLAS
             * ========================= */
            ['id_compra'=>1,'id_producto'=>1,'cantidad_compra'=>6,'precio_unitario_compra'=>18.00,'subtotal_detalle_compra'=>108.00],
            ['id_compra'=>1,'id_producto'=>6,'cantidad_compra'=>30,'precio_unitario_compra'=>0.70,'subtotal_detalle_compra'=>4.00],
            ['id_compra'=>1,'id_producto'=>11,'cantidad_compra'=>9,'precio_unitario_compra'=>2.50,'subtotal_detalle_compra'=>50.00],
            ['id_compra'=>1,'id_producto'=>16,'cantidad_compra'=>3,'precio_unitario_compra'=>35.00,'subtotal_detalle_compra'=>105.00],
            ['id_compra'=>1,'id_producto'=>4,'cantidad_compra'=>5,'precio_unitario_compra'=>12.00,'subtotal_detalle_compra'=>60.00],

            /* =========================
             * COMPRA 7 - ALTA ROTACIÓN
             * ========================= */
            ['id_compra'=>2,'id_producto'=>2,'cantidad_compra'=>10,'precio_unitario_compra'=>5.00,'subtotal_detalle_compra'=>50.00],
            ['id_compra'=>2,'id_producto'=>7,'cantidad_compra'=>60,'precio_unitario_compra'=>0.75,'subtotal_detalle_compra'=>45.00],
            ['id_compra'=>2,'id_producto'=>12,'cantidad_compra'=>9,'precio_unitario_compra'=>3.00,'subtotal_detalle_compra'=>60.00],
            ['id_compra'=>2,'id_producto'=>17,'cantidad_compra'=>2,'precio_unitario_compra'=>60.00,'subtotal_detalle_compra'=>19.00],
            ['id_compra'=>2,'id_producto'=>1,'cantidad_compra'=>6,'precio_unitario_compra'=>15.00,'subtotal_detalle_compra'=>90.00],

            /* =========================
             * COMPRA 8 - STOCK BASE
             * ========================= */
            ['id_compra'=>3,'id_producto'=>3,'cantidad_compra'=>5,'precio_unitario_compra'=>30.00,'subtotal_detalle_compra'=>150.00],
            ['id_compra'=>3,'id_producto'=>8,'cantidad_compra'=>40,'precio_unitario_compra'=>0.80,'subtotal_detalle_compra'=>32.00],
            ['id_compra'=>3,'id_producto'=>13,'cantidad_compra'=>15,'precio_unitario_compra'=>4.00,'subtotal_detalle_compra'=>60.00],
            ['id_compra'=>3,'id_producto'=>18,'cantidad_compra'=>4,'precio_unitario_compra'=>45.00,'subtotal_detalle_compra'=>180.00],
            ['id_compra'=>3,'id_producto'=>8,'cantidad_compra'=>6,'precio_unitario_compra'=>18.00,'subtotal_detalle_compra'=>108.00],

            /* =========================
             * COMPRA 9 - EVENTOS
             * ========================= */
            ['id_compra'=>4,'id_producto'=>4,'cantidad_compra'=>8,'precio_unitario_compra'=>14.00,'subtotal_detalle_compra'=>112.00],
            ['id_compra'=>4,'id_producto'=>9,'cantidad_compra'=>30,'precio_unitario_compra'=>0.85,'subtotal_detalle_compra'=>5.50],
            ['id_compra'=>4,'id_producto'=>14,'cantidad_compra'=>10,'precio_unitario_compra'=>5.50,'subtotal_detalle_compra'=>55.00],
            ['id_compra'=>4,'id_producto'=>19,'cantidad_compra'=>2,'precio_unitario_compra'=>80.00,'subtotal_detalle_compra'=>160.00],
            ['id_compra'=>4,'id_producto'=>3,'cantidad_compra'=>5,'precio_unitario_compra'=>9.00,'subtotal_detalle_compra'=>100.00],

            /* =========================
             * COMPRA 10 - GENERAL
             * ========================= */
            ['id_compra'=>5,'id_producto'=>5,'cantidad_compra'=>10,'precio_unitario_compra'=>12.00,'subtotal_detalle_compra'=>19.00],
            ['id_compra'=>5,'id_producto'=>10,'cantidad_compra'=>60,'precio_unitario_compra'=>0.65,'subtotal_detalle_compra'=>39.00],
            ['id_compra'=>5,'id_producto'=>15,'cantidad_compra'=>12,'precio_unitario_compra'=>6.00,'subtotal_detalle_compra'=>72.00],
            ['id_compra'=>5,'id_producto'=>9,'cantidad_compra'=>6,'precio_unitario_compra'=>5.00,'subtotal_detalle_compra'=>150.00],
            ['id_compra'=>5,'id_producto'=>5,'cantidad_compra'=>4,'precio_unitario_compra'=>1.00,'subtotal_detalle_compra'=>88.00],

        ]);
    }
}