<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class comprasSeeder extends Seeder
{
    public function run()
    {
        DB::table('compras')->insert([

            [
                'numero_factura_compra' => 'COM-20260504-000001',
                'id_proveedor' => 1,
                'id_usuario' => 1,
                'fecha_compra' => now(),
                'subtotal_compra' => 150.00,
                'impuesto_compra' => 22.50,
                'total_compra' => 172.50,
                'estado_compra' => true,
                'id_caja' => 1,
                'id_cuenta' => null,
                'id_metodo_pago' => 1
            ],

            [
                'numero_factura_compra' => 'COM-20260504-000002',
                'id_proveedor' => 2,
                'id_usuario' => 1,
                'fecha_compra' => now(),
                'subtotal_compra' => 220.00,
                'impuesto_compra' => 33.00,
                'total_compra' => 253.00,
                'estado_compra' => true,
                'id_caja' => null,
                'id_cuenta' => 1,
                'id_metodo_pago' => 2
            ],

            [
                'numero_factura_compra' => 'COM-20260504-000003',
                'id_proveedor' => 1,
                'id_usuario' => 2,
                'fecha_compra' => now(),
                'subtotal_compra' => 98.00,
                'impuesto_compra' => 14.70,
                'total_compra' => 112.70,
                'estado_compra' => true,
                'id_caja' => 2,
                'id_cuenta' => null,
                'id_metodo_pago' => 3
            ],

            [
                'numero_factura_compra' => 'COM-20260504-000004',
                'id_proveedor' => 3,
                'id_usuario' => 1,
                'fecha_compra' => now(),
                'subtotal_compra' => 310.00,
                'impuesto_compra' => 46.50,
                'total_compra' => 356.50,
                'estado_compra' => true,
                'id_caja' => null,
                'id_cuenta' => 2,
                'id_metodo_pago' => 4
            ],

            [
                'numero_factura_compra' => 'COM-20260504-000005',
                'id_proveedor' => 2,
                'id_usuario' => 2,
                'fecha_compra' => now(),
                'subtotal_compra' => 75.00,
                'impuesto_compra' => 11.25,
                'total_compra' => 86.25,
                'estado_compra' => true,
                'id_caja' => 2,
                'id_cuenta' => null,
                'id_metodo_pago' => 1
            ]

        ]);
    }
}