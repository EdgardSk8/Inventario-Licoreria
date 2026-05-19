<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Models\MovimientoInventario;
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

            /* 🧾 total de ventas */
            'total_ventas' => (clone $query)->count(),

            /* 💰 ingresos totales */
            'ingresos' => round(
                (float) ((clone $query)->sum('total_venta') ?? 0),
                2
            ),

            /* 📦 unidades vendidas */
            'unidades_vendidas' => (clone $query)
                ->join('detalle_ventas', 'ventas.id_venta', '=', 'detalle_ventas.id_venta')
                ->sum('detalle_ventas.cantidad_venta'),

            /* 📊 promedio por venta */
            'promedio_venta' => round(
                (float) ((clone $query)->avg('total_venta') ?? 0),
                2
            ),

            /* 🔥 ticket más alto */
            'venta_maxima' => round(
                (float) ((clone $query)->max('total_venta') ?? 0),
                2
            ),

            /* 💸 promedio de impuesto */
            'impuestos' => round(
                (float) ((clone $query)->sum('impuesto_venta') ?? 0),
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

    public function Movimientoinventario(Request $request)
    {
        $tipo = $request->get('tipo', 'dia');

        $inicio = $request->inicio;
        $fin    = $request->fin;

        $anio = $request->anio;
        $mes  = $request->mes;
        $dia  = $request->dia;

        /* ═══════════════════════
        BASE QUERY (SOLO FILTROS)
        ═══════════════════════ */

        $baseQuery = MovimientoInventario::query();

        if ($inicio && $fin) {
            $baseQuery->whereBetween('fecha_movimiento', [
                $inicio . ' 00:00:00',
                $fin . ' 23:59:59'
            ]);
        }

        if ($anio) $baseQuery->whereYear('fecha_movimiento', $anio);
        if ($mes)  $baseQuery->whereMonth('fecha_movimiento', $mes);
        if ($dia)  $baseQuery->whereDay('fecha_movimiento', $dia);

        /* ═══════════════════════
        GRÁFICA
        ═══════════════════════ */

        $graficaQuery = clone $baseQuery;

        switch ($tipo) {

            case 'dia':
                $grafica = $graficaQuery
                    ->selectRaw("DATE_FORMAT(fecha_movimiento, '%d-%m-%Y') as label")
                    ->selectRaw("tipo_movimiento")
                    ->selectRaw("SUM(cantidad_movimiento) as total")
                    ->groupBy('label', 'tipo_movimiento')
                    ->orderBy('label')
                    ->get();
                break;

            case 'mes':
                $grafica = $graficaQuery
                    ->selectRaw("DATE_FORMAT(fecha_movimiento, '%m-%Y') as label")
                    ->selectRaw("tipo_movimiento")
                    ->selectRaw("SUM(cantidad_movimiento) as total")
                    ->groupBy('label', 'tipo_movimiento')
                    ->orderBy('label')
                    ->get();
                break;

            case 'anio':
                $grafica = $graficaQuery
                    ->selectRaw("YEAR(fecha_movimiento) as label")
                    ->selectRaw("tipo_movimiento")
                    ->selectRaw("SUM(cantidad_movimiento) as total")
                    ->groupBy('label', 'tipo_movimiento')
                    ->orderBy('label')
                    ->get();
                break;

            default:
                $grafica = collect();
                break;
        }

        /* ═══════════════════════
        KPIs (CORREGIDOS Y LIMPIOS)
        ═══════════════════════ */

        $totalMovimientos = (clone $baseQuery)->count();

        $entradas = (clone $baseQuery)
            ->where('tipo_movimiento', 'ENTRADA')
            ->sum('cantidad_movimiento');

        $salidas = (clone $baseQuery)
            ->where('tipo_movimiento', 'SALIDA')
            ->sum('cantidad_movimiento');

        $referencias = (clone $baseQuery)
            ->selectRaw("COUNT(*) as total")
            ->value('total');

        $promedioMovimiento = $totalMovimientos > 0
            ? round(($entradas + $salidas) / $totalMovimientos, 2)
            : 0;

        /* ═══════════════════════
        RESPUESTA
        ═══════════════════════ */

        return response()->json([
            'grafica' => $grafica,

            'resumen' => [
                'total_movimientos' => $totalMovimientos,
                'entradas' => $entradas,
                'salidas' => $salidas,
                'balance' => $entradas - $salidas,
                'promedio_movimiento' => $promedioMovimiento,
            ],

            'por_tipo_movimiento' => (clone $baseQuery)
                ->selectRaw("tipo_movimiento as label")
                ->selectRaw("COUNT(*) as cantidad")
                ->selectRaw("SUM(cantidad_movimiento) as total")
                ->groupBy('tipo_movimiento')
                ->get(),

            'por_tipo_referencia' => (clone $baseQuery)
                ->selectRaw("tipo_referencia as label")
                ->selectRaw("COUNT(*) as cantidad")
                ->selectRaw("SUM(cantidad_movimiento) as total")
                ->groupBy('tipo_referencia')
                ->get(),
        ]);
    }

    public function ganancias(Request $request)
    {
        $tipo = $request->get('tipo', 'dia');

        $inicio = $request->inicio;
        $fin    = $request->fin;

        $anio = $request->anio;
        $mes  = $request->mes;
        $dia  = $request->dia;

        /* ════════════════
        QUERY BASE (SOLO FILTROS)
        ════════════════ */

        $baseQuery = Venta::query()
            ->where('estado_venta', 1);

        if ($inicio && $fin) {
            $baseQuery->whereBetween('fecha_venta', [
                $inicio . ' 00:00:00',
                $fin . ' 23:59:59'
            ]);
        }

        if ($anio) $baseQuery->whereYear('fecha_venta', $anio);
        if ($mes)  $baseQuery->whereMonth('fecha_venta', $mes);
        if ($dia)  $baseQuery->whereDay('fecha_venta', $dia);

        /* ════════════════
        QUERY CON JOINS (SOLO PARA GRÁFICA)
        ════════════════ */

        $query = (clone $baseQuery)
            ->join('detalle_ventas', 'ventas.id_venta', '=', 'detalle_ventas.id_venta')
            ->join('productos', 'detalle_ventas.id_producto', '=', 'productos.id_producto');

        /* ════════════════
        FÓRMULA GANANCIA
        ════════════════ */

        $gananciaSQL = "
            SUM(
                (detalle_ventas.precio_unitario_venta - productos.precio_compra)
                * detalle_ventas.cantidad_venta
            )
        ";

        /* ════════════════
        GRÁFICA
        ════════════════ */

        switch ($tipo) {

            case 'dia':
                $grafica = (clone $query)
                    ->selectRaw("DATE_FORMAT(fecha_venta, '%d-%m-%y') as label")
                    ->selectRaw("$gananciaSQL as ganancia")
                    ->groupBy(DB::raw("DATE_FORMAT(fecha_venta, '%d-%m-%y')"))
                    ->orderBy('label')
                    ->get();
                break;

            case 'mes':
                $grafica = (clone $query)
                    ->selectRaw("DATE_FORMAT(fecha_venta, '%m-%Y') as label")
                    ->selectRaw("$gananciaSQL as ganancia")
                    ->groupBy(DB::raw("DATE_FORMAT(fecha_venta, '%m-%Y')"))
                    ->orderBy('label')
                    ->get();
                break;

            case 'anio':
                $grafica = (clone $query)
                    ->selectRaw("YEAR(fecha_venta) as label")
                    ->selectRaw("$gananciaSQL as ganancia")
                    ->groupBy(DB::raw("YEAR(fecha_venta)"))
                    ->orderBy('label')
                    ->get();
                break;

            case 'hora':
                $grafica = (clone $query)
                    ->selectRaw("DATE_FORMAT(fecha_venta, '%H:00') as label")
                    ->selectRaw("$gananciaSQL as ganancia")
                    ->groupBy(DB::raw("DATE_FORMAT(fecha_venta, '%H:00')"))
                    ->orderBy('label')
                    ->get();
                break;

            default:
                $grafica = collect();
                break;
        }

        /* ════════════════
        KPIs (SIN DUPLICAR JOINS)
        ════════════════ */

        $gananciaTotal = (clone $query)
            ->selectRaw("$gananciaSQL as ganancia")
            ->value('ganancia');

        $totalUnidades = (clone $baseQuery)
            ->join('detalle_ventas', 'ventas.id_venta', '=', 'detalle_ventas.id_venta')
            ->sum('detalle_ventas.cantidad_venta');

        $ingresos = (clone $baseQuery)
            ->sum('total_venta');

        $ventasTotales = (clone $baseQuery)
            ->count('ventas.id_venta');

        $margenPorVenta = $ingresos > 0
            ? round(($gananciaTotal / $ingresos) * 100, 2)
            : 0;

        /* ════════════════
        RESPUESTA
        ════════════════ */

        return response()->json([

            'grafica' => $grafica,

            'kpis' => [

                // 💰 Ganancia total real
                'ganancia_total' => round($gananciaTotal ?? 0, 2),

                // 💵 Ingresos totales
                'ingresos' => round($ingresos ?? 0, 2),

                // 📦 Ganancia promedio por unidad
                'ganancia_por_unidad' => $totalUnidades > 0
                    ? round($gananciaTotal / $totalUnidades, 2)
                    : 0,

                // 📊 % de ganancia por venta (MARGEN REAL)
                'margen_por_venta' => $margenPorVenta,

                // 🧾 Total de ventas realizadas
                'ventas_totales' => $ventasTotales,
            ],
        ]);
    }

}