<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ventasSeeder extends Seeder
{
    public function run()
    {
        DB::table('ventas')->insert([

            [
                'numero_factura' => 'VTA-20260504-00001',
                'fecha_venta' => now(),
                'id_cliente' => 1,
                'id_usuario' => 1,
                'id_caja' => 1,
                'id_cuenta' => null,
                'subtotal_venta' => 45.00,
                'impuesto_venta' => 6.75,
                'total_venta' => 51.75,
                'estado_venta' => true,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'VTA-20260504-00002',
                'fecha_venta' => now(),
                'id_cliente' => 2,
                'id_usuario' => 1,
                'id_caja' => null,
                'id_cuenta' => 1,
                'subtotal_venta' => 60.00,
                'impuesto_venta' => 9.00,
                'total_venta' => 69.00,
                'estado_venta' => true,
                'id_metodo_pago' => 2
            ],

            [
                'numero_factura' => 'VTA-20260504-00003',
                'fecha_venta' => now(),
                'id_cliente' => 3,
                'id_usuario' => 2,
                'id_caja' => 1,
                'id_cuenta' => null,
                'subtotal_venta' => 51.00,
                'impuesto_venta' => 7.65,
                'total_venta' => 58.65,
                'estado_venta' => true,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'VTA-20260504-00004',
                'fecha_venta' => now(),
                'id_cliente' => 1,
                'id_usuario' => 2,
                'id_caja' => 1,
                'id_cuenta' => null,
                'subtotal_venta' => 70.00,
                'impuesto_venta' => 10.50,
                'total_venta' => 80.50,
                'estado_venta' => true,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'VTA-20260504-00005',
                'fecha_venta' => now(),
                'id_cliente' => 4,
                'id_usuario' => 1,
                'id_caja' => null,
                'id_cuenta' => 2,
                'subtotal_venta' => 38.00,
                'impuesto_venta' => 5.70,
                'total_venta' => 43.70,
                'estado_venta' => true,
                'id_metodo_pago' => 3
            ],

            [
                'numero_factura' => 'VTA-20260504-00006',
                'fecha_venta' => now(),
                'id_cliente' => 5,
                'id_usuario' => 1,
                'id_caja' => 1,
                'id_cuenta' => null,
                'subtotal_venta' => 20.00,
                'impuesto_venta' => 3.00,
                'total_venta' => 23.00,
                'estado_venta' => true,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'VTA-20260504-00007',
                'fecha_venta' => now(),
                'id_cliente' => 2,
                'id_usuario' => 2,
                'id_caja' => null,
                'id_cuenta' => 1,
                'subtotal_venta' => 46.00,
                'impuesto_venta' => 6.90,
                'total_venta' => 52.90,
                'estado_venta' => true,
                'id_metodo_pago' => 2
            ],

            [
                'numero_factura' => 'VTA-20260504-00008',
                'fecha_venta' => now(),
                'id_cliente' => 3,
                'id_usuario' => 1,
                'id_caja' => 1,
                'id_cuenta' => null,
                'subtotal_venta' => 75.00,
                'impuesto_venta' => 11.25,
                'total_venta' => 86.25,
                'estado_venta' => true,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'VTA-20260504-00009',
                'fecha_venta' => now(),
                'id_cliente' => 4,
                'id_usuario' => 2,
                'id_caja' => 1,
                'id_cuenta' => null,
                'subtotal_venta' => 36.00,
                'impuesto_venta' => 5.40,
                'total_venta' => 41.40,
                'estado_venta' => true,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura' => 'VTA-20260504-00010',
                'fecha_venta' => now(),
                'id_cliente' => 5,
                'id_usuario' => 1,
                'id_caja' => null,
                'id_cuenta' => 2,
                'subtotal_venta' => 75.00,
                'impuesto_venta' => 11.25,
                'total_venta' => 86.25,
                'estado_venta' => true,
                'id_metodo_pago' => 2
            ]

        ]);
    }
}