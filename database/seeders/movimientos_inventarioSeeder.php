<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class movimientos_inventarioSeeder extends Seeder
{
    public function run()
    {
        $movimientos = [];

        $productos = range(1, 20);
        $usuarios = range(1, 3);

        $tipos = ['ENTRADA', 'SALIDA', 'AJUSTE'];
        $referencias = [null, 1, 2, 3];
        $tiposRef = ['VENTA', 'COMPRA', 'DEVOLUCION', 'TRASLADO'];

        $motivos = [
            'Compra inicial',
            'Venta mostrador',
            'Ajuste de inventario',
            'Producto dañado',
            'Devolución de cliente',
            'Transferencia entre almacenes',
            'Reabastecimiento',
            'Corrección de stock'
        ];

        // Stock base por producto (para coherencia)
        $stockActual = [];

        foreach ($productos as $p) {
            $stockActual[$p] = rand(50, 80);
        }

        for ($i = 1; $i <= 500; $i++) {

            $producto = $productos[array_rand($productos)];
            $tipo = $tipos[array_rand($tipos)];

            $cantidad = rand(5, 30);

            // lógica de stock coherente
            if ($tipo === 'ENTRADA') {
                $stockActual[$producto] += $cantidad;
            } elseif ($tipo === 'SALIDA') {
                $stockActual[$producto] -= $cantidad;
                if ($stockActual[$producto] < 50) {
                    $stockActual[$producto] += $cantidad; // evita stock negativo o bajo
                    $tipo = 'ENTRADA';
                }
            } else { // AJUSTE
                $stockActual[$producto] = max(50, $stockActual[$producto] - $cantidad);
            }

            // mantener rango 50 - 120
            if ($stockActual[$producto] > 120) {
                $stockActual[$producto] = 120;
            }

            $refIndex = array_rand($referencias);
            $tipoRef = $tiposRef[array_rand($tiposRef)];

            $fecha = strtotime("2026-05-01 08:00:00") + rand(0, 30 * 24 * 60 * 60);

            $movimientos[] = [
                'id_producto' => $producto,
                'tipo_movimiento' => $tipo,
                'cantidad_movimiento' => $cantidad,
                'stock_resultante' => $stockActual[$producto],
                'motivo_movimiento' => $motivos[array_rand($motivos)],
                'id_referencia' => $referencias[$refIndex],
                'tipo_referencia' => $tipoRef,
                'precio_unitario' => rand(2000, 2500) / 100, // 20 - 25
                'fecha_movimiento' => date('Y-m-d H:i:s', $fecha),
                'id_usuario' => $usuarios[array_rand($usuarios)]
            ];
        }

        DB::table('movimientos_inventario')->insert($movimientos);
    }
}