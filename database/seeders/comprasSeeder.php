<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class comprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compras')->insert([
            [
                'numero_factura_compra' => 'FAC-001',
                'id_proveedor' => 1,
                'id_usuario' => 1,

                'fecha_compra' => now(),

                'subtotal_compra' => 150.00,
                'impuesto_compra' => 22.50,
                'total_compra' => 172.50,

                'estado_compra' => true,

                // 👇 pago en efectivo
                'id_caja' => 1,
                'id_cuenta' => null,
            ],

            [
                'numero_factura_compra' => 'FAC-002',
                'id_proveedor' => 2,
                'id_usuario' => 1,

                'fecha_compra' => now(),

                'subtotal_compra' => 220.00,
                'impuesto_compra' => 33.00,
                'total_compra' => 253.00,

                'estado_compra' => true,

                // 👇 pago por banco
                'id_caja' => null,
                'id_cuenta' => 1,
            ],

            [
                'numero_factura_compra' => 'FAC-003',
                'id_proveedor' => 1,
                'id_usuario' => 2,

                'fecha_compra' => now(),

                'subtotal_compra' => 98.00,
                'impuesto_compra' => 14.70,
                'total_compra' => 112.70,

                'estado_compra' => true,

                'id_caja' => 2,
                'id_cuenta' => null,
            ],

            [
                'numero_factura_compra' => 'FAC-004',
                'id_proveedor' => 3,
                'id_usuario' => 1,

                'fecha_compra' => now(),

                'subtotal_compra' => 310.00,
                'impuesto_compra' => 46.50,
                'total_compra' => 356.50,

                'estado_compra' => true,

                'id_caja' => null,
                'id_cuenta' => 2,
            ],

            [
                'numero_factura_compra' => 'FAC-005',
                'id_proveedor' => 2,
                'id_usuario' => 2,

                'fecha_compra' => now(),

                'subtotal_compra' => 75.00,
                'impuesto_compra' => 11.25,
                'total_compra' => 86.25,

                'estado_compra' => true,

                'id_caja' => 2,
                'id_cuenta' => null,
            ]
        ]);
    }
}
