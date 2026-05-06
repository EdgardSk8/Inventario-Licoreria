<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class movimientos_cajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movimientos_caja')->insert([

            // ───────── APERTURA ─────────
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Apertura de caja',
                'monto_movimiento_caja' => 2000.00,
                'fecha_movimiento_caja' => now()->subHours(10),
                'id_usuario' => 1,
                'id_referencia' => null,
                'id_cuenta_destino' => null
            ],

            // ───────── VENTAS ─────────
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Venta mostrador #1001',
                'monto_movimiento_caja' => 350.50,
                'fecha_movimiento_caja' => now()->subHours(9),
                'id_usuario' => 1,
                'id_referencia' => 1,
                'id_cuenta_destino' => null
            ],
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Venta mostrador #1002',
                'monto_movimiento_caja' => 120.00,
                'fecha_movimiento_caja' => now()->subHours(8),
                'id_usuario' => 2,
                'id_referencia' => 2,
                'id_cuenta_destino' => null
            ],
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Venta mostrador #1003',
                'monto_movimiento_caja' => 560.75,
                'fecha_movimiento_caja' => now()->subHours(7),
                'id_usuario' => 1,
                'id_referencia' => 3,
                'id_cuenta_destino' => null
            ],

            // ───────── SALIDAS ─────────
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Pago proveedor cerveza',
                'monto_movimiento_caja' => 500.00,
                'fecha_movimiento_caja' => now()->subHours(6),
                'id_usuario' => 1,
                'id_referencia' => 2,
                'id_cuenta_destino' => null
            ],
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Compra hielo para refrigeración',
                'monto_movimiento_caja' => 45.00,
                'fecha_movimiento_caja' => now()->subHours(6),
                'id_usuario' => 2,
                'id_referencia' => null,
                'id_cuenta_destino' => null
            ],
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Pago transporte proveedor',
                'monto_movimiento_caja' => 80.00,
                'fecha_movimiento_caja' => now()->subHours(5),
                'id_usuario' => 1,
                'id_referencia' => null,
                'id_cuenta_destino' => null
            ],

            // ───────── TRANSFERENCIAS ─────────
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Transferencia a Banco BAC',
                'monto_movimiento_caja' => 800.00,
                'fecha_movimiento_caja' => now()->subHours(4),
                'id_usuario' => 1,
                'id_referencia' => null,
                'id_cuenta_destino' => 1
            ],
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Transferencia a cuenta ahorro',
                'monto_movimiento_caja' => 300.00,
                'fecha_movimiento_caja' => now()->subHours(4),
                'id_usuario' => 2,
                'id_referencia' => null,
                'id_cuenta_destino' => 3
            ],

            // ───────── MÁS VENTAS ─────────
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Venta nocturna',
                'monto_movimiento_caja' => 220.00,
                'fecha_movimiento_caja' => now()->subHours(3),
                'id_usuario' => 1,
                'id_referencia' => 4,
                'id_cuenta_destino' => null
            ],
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Venta cerveza 6 pack',
                'monto_movimiento_caja' => 180.00,
                'fecha_movimiento_caja' => now()->subHours(2),
                'id_usuario' => 2,
                'id_referencia' => 5,
                'id_cuenta_destino' => null
            ],

            // ───────── GASTOS OPERATIVOS ─────────
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Compra bolsas y empaque',
                'monto_movimiento_caja' => 25.00,
                'fecha_movimiento_caja' => now()->subHours(2),
                'id_usuario' => 1,
                'id_referencia' => null,
                'id_cuenta_destino' => null
            ],
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'SALIDA',
                'concepto_movimiento_caja' => 'Pago limpieza local',
                'monto_movimiento_caja' => 60.00,
                'fecha_movimiento_caja' => now()->subHours(1),
                'id_usuario' => 2,
                'id_referencia' => null,
                'id_cuenta_destino' => null
            ],

            // ───────── ÚLTIMA VENTA ─────────
            [
                'id_caja' => 1,
                'tipo_movimiento_caja' => 'INGRESO',
                'concepto_movimiento_caja' => 'Venta cierre de turno',
                'monto_movimiento_caja' => 410.00,
                'fecha_movimiento_caja' => now()->subMinutes(30),
                'id_usuario' => 1,
                'id_referencia' => 6,
                'id_cuenta_destino' => null
            ],

        ]);
    }
}
