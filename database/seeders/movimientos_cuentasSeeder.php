<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class movimientos_cuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movimientos_cuentas')->insert([

            // ─────────────────────────────
            // CUENTA 1: CAJA GENERAL
            // ─────────────────────────────
            [
                'id_cuenta' => 1,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 5000.00,
                'descripcion' => 'Saldo inicial caja general',
                'fecha' => now()->subDays(5),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 1,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 1200.00,
                'descripcion' => 'Transferencia desde ventas del día',
                'fecha' => now()->subDays(4),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 1,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 500.00,
                'descripcion' => 'Pago proveedor cervezas',
                'fecha' => now()->subDays(4),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 1,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 180.00,
                'descripcion' => 'Compra insumos (hielo y bolsas)',
                'fecha' => now()->subDays(3),
                'id_usuario' => 2
            ],
            [
                'id_cuenta' => 1,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 860.50,
                'descripcion' => 'Ventas turno nocturno',
                'fecha' => now()->subDays(2),
                'id_usuario' => 1
            ],

            // ─────────────────────────────
            // CUENTA 2: BANCO BAC
            // ─────────────────────────────
            [
                'id_cuenta' => 2,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 3200.50,
                'descripcion' => 'Depósito inicial cuenta BAC',
                'fecha' => now()->subDays(6),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 2,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 1500.00,
                'descripcion' => 'Transferencia desde caja general',
                'fecha' => now()->subDays(3),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 2,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 300.00,
                'descripcion' => 'Pago servicio internet',
                'fecha' => now()->subDays(2),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 2,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 250.00,
                'descripcion' => 'Comisión bancaria',
                'fecha' => now()->subDays(1),
                'id_usuario' => 2
            ],
            [
                'id_cuenta' => 2,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 980.75,
                'descripcion' => 'Depósito ventas POS',
                'fecha' => now(),
                'id_usuario' => 1
            ],

            // ─────────────────────────────
            // CUENTA 3: AHORRO
            // ─────────────────────────────
            [
                'id_cuenta' => 3,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 10000.00,
                'descripcion' => 'Fondo de ahorro inicial negocio',
                'fecha' => now()->subDays(10),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 3,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 2000.00,
                'descripcion' => 'Transferencia desde utilidades',
                'fecha' => now()->subDays(5),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 3,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 1500.00,
                'descripcion' => 'Inversión en nuevo inventario',
                'fecha' => now()->subDays(3),
                'id_usuario' => 1
            ],
            [
                'id_cuenta' => 3,
                'tipo_movimiento' => 'SALIDA',
                'monto' => 800.00,
                'descripcion' => 'Compra refrigerador',
                'fecha' => now()->subDays(2),
                'id_usuario' => 2
            ],
            [
                'id_cuenta' => 3,
                'tipo_movimiento' => 'INGRESO',
                'monto' => 600.00,
                'descripcion' => 'Retorno de inversión pequeña',
                'fecha' => now(),
                'id_usuario' => 1
            ],
        ]);
    }
}