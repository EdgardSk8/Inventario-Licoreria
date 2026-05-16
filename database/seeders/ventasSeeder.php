<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ventasSeeder extends Seeder
{
    public function run()
    {
        $ventas = [];

        $clientes = range(1, 9);
        $usuarios = range(1, 3);
        $cajas = range(1, 6);
        $cuentas = range(1, 7);
        $metodos = range(1, 4);

        $fechaBase = strtotime("2026-05-01 08:00:00");

        for ($i = 1; $i <= 500; $i++) {

            $subtotal = rand(280, 520);
            $impuesto = round($subtotal * 0.15, 2);
            $total = $subtotal + $impuesto;

            $ventas[] = [
                'numero_factura' => 'VTA-20260515-' . str_pad($i, 5, '0', STR_PAD_LEFT),

                'fecha_venta' => date(
                    'Y-m-d H:i:s',
                    $fechaBase + ($i * rand(8000, 20000))
                ),

                'id_cliente' => $clientes[array_rand($clientes)],
                'id_usuario' => $usuarios[array_rand($usuarios)],

                'id_caja' => (rand(0, 1) ? $cajas[array_rand($cajas)] : null),

                'id_cuenta' => (rand(0, 1) ? $cuentas[array_rand($cuentas)] : null),

                'subtotal_venta' => $subtotal,
                'impuesto_venta' => $impuesto,
                'total_venta' => $total,

                'estado_venta' => true,

                'id_metodo_pago' => $metodos[array_rand($metodos)]
            ];
        }

        DB::table('ventas')->insert($ventas);
    }
}