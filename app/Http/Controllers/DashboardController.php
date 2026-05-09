<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;

class DashboardController extends Controller
{
    public function ventas(Request $request)
    {
        $tipo = $request->get('tipo', 'dia');

        $inicio = $request->inicio;
        $fin = $request->fin;

        $anio = $request->anio;
        $mes = $request->mes;
        $dia = $request->dia;

        $query = Venta::query()
            ->where('estado_venta', 1);

        /* ════════════════
        FILTROS
        ════════════════ */

        // rango fechas
        if ($inicio && $fin) {

            $query->whereBetween('fecha_venta', [
                $inicio . ' 00:00:00',
                $fin . ' 23:59:59'
            ]);
        }

        // jerárquicos
        if ($anio) {
            $query->whereYear('fecha_venta', $anio);
        }

        if ($mes) {
            $query->whereMonth('fecha_venta', $mes);
        }

        if ($dia) {
            $query->whereDay('fecha_venta', $dia);
        }

        /* ════════════════
        GRÁFICA PRINCIPAL
        ════════════════ */

        switch ($tipo) {

            case 'dia':

                $grafica = (clone $query)
                    ->selectRaw("DATE_FORMAT(fecha_venta, '%d-%m-%y') as label")
                    ->selectRaw('COUNT(*) as cantidad')
                    ->selectRaw('SUM(total_venta) as total')
                    ->groupBy(DB::raw("DATE_FORMAT(fecha_venta, '%d-%m-%y')"))
                    ->orderBy('label')
                    ->get();

                break;

            case 'mes':

                $grafica = (clone $query)
                    ->selectRaw("DATE_FORMAT(fecha_venta, '%m-%Y') as label")
                    ->selectRaw('COUNT(*) as cantidad')
                    ->selectRaw('SUM(total_venta) as total')
                    ->groupBy(DB::raw("DATE_FORMAT(fecha_venta, '%m-%Y')"))
                    ->orderBy('label')
                    ->get();

                break;

            case 'anio':

                $grafica = (clone $query)
                    ->selectRaw('YEAR(fecha_venta) as label')
                    ->selectRaw('COUNT(*) as cantidad')
                    ->selectRaw('SUM(total_venta) as total')
                    ->groupBy(DB::raw('YEAR(fecha_venta)'))
                    ->orderBy('label')
                    ->get();

                break;

            case 'hora':

                $grafica = (clone $query)
                    ->selectRaw("DATE_FORMAT(fecha_venta, '%H:00') as label")
                    ->selectRaw('COUNT(*) as cantidad')
                    ->selectRaw('SUM(total_venta) as total')
                    ->groupBy(DB::raw("DATE_FORMAT(fecha_venta, '%H:00')"))
                    ->orderBy('label')
                    ->get();

                break;

            default:

                $grafica = collect();

                break;
        }

        /* ════════════════
        RESPUESTA
        ════════════════ */

        return response()->json([

            /* 🔹 gráfica */
            'grafica' => $grafica,

            /* 🔹 KPIs */
            'kpis' => [

                'total_ventas' => (clone $query)->count(),

                'ingresos' => round(
                    (float) ((clone $query)->sum('total_venta') ?? 0),
                    2
                ),

                'impuestos' => round(
                    (float) ((clone $query)->sum('impuesto_venta') ?? 0),
                    2
                ),

                'promedio_venta' => round(
                    (float) ((clone $query)->avg('total_venta') ?? 0),
                    2
                ),
            ],

            /* 🔹 clientes */
            'clientes' => (clone $query)

                ->leftJoin(
                    'clientes',
                    'ventas.id_cliente',
                    '=',
                    'clientes.id_cliente'
                )

                ->selectRaw("
                    COALESCE(
                        clientes.nombre_cliente,
                        'Sin cliente'
                    ) as label
                ")

                ->selectRaw('COUNT(*) as ventas')
                ->selectRaw('SUM(total_venta) as total')

                ->groupBy(
                    'clientes.id_cliente',
                    'clientes.nombre_cliente'
                )

                ->orderByDesc('total')

                ->get(),

            /* 🔹 usuarios */
            'usuarios' => (clone $query)

                ->leftJoin(
                    'usuarios',
                    'ventas.id_usuario',
                    '=',
                    'usuarios.id_usuario'
                )

                ->selectRaw("
                    COALESCE(
                        usuarios.nombre_usuario,
                        'Sin usuario'
                    ) as label
                ")

                ->selectRaw('COUNT(*) as ventas')
                ->selectRaw('SUM(total_venta) as total')

                ->groupBy(
                    'usuarios.id_usuario',
                    'usuarios.nombre_usuario'
                )

                ->orderByDesc('total')

                ->get(),

            /* 🔹 métodos pago */
            'metodos_pago' => (clone $query)

                ->leftJoin(
                    'metodos_pago',
                    'ventas.id_metodo_pago',
                    '=',
                    'metodos_pago.id_metodo_pago'
                )

                ->selectRaw("
                    COALESCE(
                        metodos_pago.nombre_metodo_pago,
                        'Sin método'
                    ) as label
                ")

                ->selectRaw('COUNT(*) as ventas')
                ->selectRaw('SUM(total_venta) as total')

                ->groupBy(
                    'metodos_pago.id_metodo_pago',
                    'metodos_pago.nombre_metodo_pago'
                )

                ->orderByDesc('total')

                ->get(),

            /* 🔹 estado */
            'estado' => Venta::query()

                ->selectRaw("
                    CASE
                        WHEN estado_venta = 1
                        THEN 'Activa'
                        ELSE 'Anulada'
                    END as label
                ")

                ->selectRaw('COUNT(*) as cantidad')
                ->selectRaw('SUM(total_venta) as total')

                ->groupBy('estado_venta')

                ->get(),

            /* 🔹 días fuertes */
                'dias_fuertes' => (clone $query)

                    ->selectRaw('DAYOFWEEK(fecha_venta) as orden')

                    ->selectRaw("
                        CASE DAYOFWEEK(fecha_venta)
                            WHEN 1 THEN 'Domingo'
                            WHEN 2 THEN 'Lunes'
                            WHEN 3 THEN 'Martes'
                            WHEN 4 THEN 'Miércoles'
                            WHEN 5 THEN 'Jueves'
                            WHEN 6 THEN 'Viernes'
                            WHEN 7 THEN 'Sábado'
                        END as label
                    ")

                    ->selectRaw('COUNT(*) as cantidad')
                    ->selectRaw('SUM(total_venta) as total')

                    ->groupBy('orden', 'label')

                    ->orderBy('orden')

                    ->get()

                        ]);
    }

}