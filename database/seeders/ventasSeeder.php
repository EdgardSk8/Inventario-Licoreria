<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ventasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('ventas')->insert([

            [
                'numero_factura' => 'F001',
                'id_cliente' => 1,
                'id_usuario' => 1,
                'id_caja' => 1,
                'subtotal_venta' => 45,
                'impuesto_venta' => 6.75,
                'total_venta' => 51.75,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'F002',
                'id_cliente' => 2,
                'id_usuario' => 1,
                'id_caja' => 1,
                'subtotal_venta' => 60,
                'impuesto_venta' => 9,
                'total_venta' => 69,
                'id_metodo_pago' => 2
            ],

            [
                'numero_factura' => 'F003',
                'id_cliente' => 3,
                'id_usuario' => 2,
                'id_caja' => 1,
                'subtotal_venta' => 51,
                'impuesto_venta' => 7.65,
                'total_venta' => 58.65,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'F004',
                'id_cliente' => 1,
                'id_usuario' => 2,
                'id_caja' => 1,
                'subtotal_venta' => 70,
                'impuesto_venta' => 10.5,
                'total_venta' => 80.5,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'F005',
                'id_cliente' => 4,
                'id_usuario' => 1,
                'id_caja' => 1,
                'subtotal_venta' => 38,
                'impuesto_venta' => 5.7,
                'total_venta' => 43.7,
                'id_metodo_pago' => 3
            ],

            [
                'numero_factura' => 'F006',
                'id_cliente' => 5,
                'id_usuario' => 1,
                'id_caja' => 1,
                'subtotal_venta' => 20,
                'impuesto_venta' => 3,
                'total_venta' => 23,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'F007',
                'id_cliente' => 2,
                'id_usuario' => 2,
                'id_caja' => 1,
                'subtotal_venta' => 46,
                'impuesto_venta' => 6.9,
                'total_venta' => 52.9,
                'id_metodo_pago' => 2
            ],

            [
                'numero_factura' => 'F008',
                'id_cliente' => 3,
                'id_usuario' => 1,
                'id_caja' => 1,
                'subtotal_venta' => 75,
                'impuesto_venta' => 11.25,
                'total_venta' => 86.25,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'F009',
                'id_cliente' => 4,
                'id_usuario' => 2,
                'id_caja' => 1,
                'subtotal_venta' => 36,
                'impuesto_venta' => 5.4,
                'total_venta' => 41.4,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'F010',
                'id_cliente' => 5,
                'id_usuario' => 1,
                'id_caja' => 1,
                'subtotal_venta' => 75,
                'impuesto_venta' => 11.25,
                'total_venta' => 86.25,
                'id_metodo_pago' => 2
            ]

        ]);
    }
}
