<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cuenta;
use App\Models\MovimientoCuenta;
use App\Models\Caja;
use App\Models\MovimientoCaja;
use App\Models\TransferenciaCajaCuenta;

class TransferenciaCajaCuentaController extends Controller
{
    
/*  ╔══════ Transferir Caja a Cuenta ══════╗ 
    ╚══════════════════════════════════════╝ */

    public function TransferenciaCajaCuenta(Request $request)
    {
        try {

            return DB::transaction(function () use ($request) {

                $idCaja = $request->id_caja;
                $idCuenta = $request->id_cuenta;
                $monto = floatval($request->monto);
                $idUsuario = auth()->id() ?? 1;

                if (!$idCaja || !$idCuenta || $monto <= 0) {
                    throw new \Exception("Datos inválidos");
                }

                $caja = Caja::findOrFail($idCaja);
                $cuenta = Cuenta::findOrFail($idCuenta);

                // SALDO CAJA
                $ingresos = MovimientoCaja::where('id_caja', $idCaja)
                    ->where('tipo_movimiento_caja', 'INGRESO')
                    ->sum('monto_movimiento_caja');

                $salidas = MovimientoCaja::where('id_caja', $idCaja)
                    ->where('tipo_movimiento_caja', 'SALIDA')
                    ->sum('monto_movimiento_caja');

                $saldoCaja = ($caja->monto_inicial ?? 0) + $ingresos - $salidas;

                if ($saldoCaja < $monto) {
                    throw new \Exception("Saldo insuficiente");
                }

                // 🔴 MOVIMIENTO EN CAJA (SALIDA)
                MovimientoCaja::create([
                    'id_caja' => $idCaja,
                    'tipo_movimiento_caja' => 'SALIDA',
                    'concepto_movimiento_caja' => 'Transferencia a cuenta ' . $cuenta->nombre_cuenta,
                    'monto_movimiento_caja' => $monto,
                    'fecha_movimiento_caja' => now(),
                    'id_usuario' => $idUsuario,
                    'id_cuenta_destino' => $idCuenta
                ]);

                // 🟢 MOVIMIENTO EN CUENTA (INGRESO)
                MovimientoCuenta::create([
                    'id_cuenta' => $idCuenta,
                    'tipo_movimiento' => 'INGRESO',
                    'descripcion' => 'Transferencia desde caja #' . $idCaja,
                    'monto' => $monto,
                    'fecha' => now(),
                    'id_usuario' => $idUsuario,

                    // 🔥 CLAVE PARA HISTORIAL
                    'id_caja_origen' => $idCaja
                ]);

                TransferenciaCajaCuenta::create([
                    'id_caja_origen' => $idCaja,
                    'id_cuenta_destino' => $idCuenta,
                    'monto' => $monto,
                    'concepto' => 'Transferencia de Caja a Cuenta',
                    'id_usuario' => $idUsuario,
                    'fecha' => now()
                ]);

                // ACTUALIZAR SALDO CUENTA
                $cuenta->increment('saldo_actual', $monto);

                return response()->json([
                    'success' => true,
                    'mensaje' => 'Transferencia realizada correctamente'
                ]);
            });

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔═══════ Mostrar Transferencias ═══════╗ 
    ╚══════════════════════════════════════╝ */

    public function MostrarCajaTransferencia()
    {
        try {

            $cajas = Caja::orderBy('fecha_apertura', 'desc')->get();

            $data = $cajas->map(function ($caja) {

                $ingresos = MovimientoCaja::where('id_caja', $caja->id_caja)
                    ->where('tipo_movimiento_caja', 'INGRESO')
                    ->sum('monto_movimiento_caja');

                $salidas = MovimientoCaja::where('id_caja', $caja->id_caja)
                    ->where('tipo_movimiento_caja', 'SALIDA')
                    ->sum('monto_movimiento_caja');

                $transferido = MovimientoCaja::where('id_caja', $caja->id_caja)
                    ->whereNotNull('id_cuenta_destino')
                    ->sum('monto_movimiento_caja');

                // 🔥 última transferencia
                $ultima = MovimientoCaja::where('id_caja', $caja->id_caja)
                    ->whereNotNull('id_cuenta_destino')
                    ->latest('fecha_movimiento_caja')
                    ->first();

                $cuenta = $ultima?->cuentaDestino;

                $saldoCaja = $caja->monto_inicial + $ingresos - $salidas;

                return [
                    'numero_caja'       => $caja->id_caja,
                    'fecha_cierre'      => $caja->fecha_cierre,
                    'monto_inicial'     => $caja->monto_inicial,
                    'monto_final'       => $caja->monto_final,
                    'monto_transferido' => $transferido,
                    'saldo_caja'        => $saldoCaja,
                    'nombre_cuenta'     => $cuenta?->nombre_cuenta ?? null,
                    'saldo_cuenta'      => $cuenta?->saldo_actual ?? null
                ];
            });

            return response()->json([
                'data' => $data
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔═ Mostrar Detalles de Transferencias ═╗ 
    ╚══════════════════════════════════════╝ */

    public function MostrarDetalleCuenta($id_caja)
    {
        try {

            $transferencias = TransferenciaCajaCuenta::with([
                    'cuentaDestino',
                    'usuario'
                ])
                ->where('id_caja_origen', $id_caja)
                ->orderBy('id_transferencia', 'desc')
                ->get();

            $data = $transferencias->map(function ($t) {

                return [
                    'id' => $t->id_transferencia,

                    // 💰 cuenta destino
                    'nombre_cuenta' => $t->cuentaDestino->nombre_cuenta ?? 'Sin cuenta',

                    // 💰 monto transferido
                    'monto' => (float) $t->monto,

                    // 💰 saldo actual de la cuenta
                    'saldo_cuenta' => (float) ($t->cuentaDestino->saldo_actual ?? 0),

                    // 👤 usuario que hizo la transferencia
                    'usuario' => $t->usuario->nombre_completo_usuario ?? 'Sin usuario',

                    'fecha' => $t->fecha,
                ];
            });

            $saldoCuenta = optional(
                $transferencias->first()?->cuentaDestino
            )->saldo_actual ?? 0;

            return response()->json([
                'success' => true,
                'data' => $data,
                'total' => $data->sum('monto'),
                'cantidad' => $data->count(),
                'saldo_cuenta' => $saldoCuenta
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'mensaje' => 'Error al obtener detalle',
                'error' => $e->getMessage()
            ], 500);
        }
    }


} // Fin de controlador
