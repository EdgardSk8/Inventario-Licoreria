<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Caja;
use App\Models\MovimientoCaja;


class CajaController extends Controller
{ /* MODIFICAR */

/*  ╔════════════ Abrir Caja ═════════════╗ 
    ╚═════════════════════════════════════╝ */

    public function AbrirCaja(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'monto_inicial' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $idUsuario = session('usuario.id');

        if (!$idUsuario) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Sesión no válida'
            ], 401);
        }

        try {

            DB::transaction(function () use ($request, $idUsuario, &$caja) {

                $cajaAbierta = Caja::where('estado_caja', 1)
                    ->where('id_usuario', $idUsuario)
                    ->lockForUpdate()
                    ->first();

                if ($cajaAbierta) {
                    throw new \Exception('Ya tienes una caja abierta.');
                }

                $caja = Caja::create([
                    'fecha_apertura' => now(),
                    'monto_inicial' => $request->monto_inicial,
                    'id_usuario' => $idUsuario,
                    'estado_caja' => 1
                ]);
            });

            session(['caja_id' => $caja->id_caja]);

            return response()->json([
                'success' => true,
                'mensaje' => 'Caja abierta correctamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mensaje' => $e->getMessage()
            ], 400);
        }
    }

/*  ╔════════════ Cerrar Caja ═════════════╗ 
    ╚══════════════════════════════════════╝ */

    public function CerrarCaja()
    {
        $idUsuario = session('usuario.id');

        if (!$idUsuario) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Sesión no válida'
            ], 401);
        }

        try {

            DB::beginTransaction();

            $caja = Caja::where('estado_caja', 1)
                ->where('id_usuario', $idUsuario)
                ->lockForUpdate()
                ->first();

            if (!$caja) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'No hay caja abierta'
                ], 400);
            }

            $totales = MovimientoCaja::selectRaw("
                SUM(CASE WHEN tipo_movimiento_caja = 'INGRESO' THEN monto_movimiento_caja ELSE 0 END) as ingresos,
                SUM(CASE WHEN tipo_movimiento_caja = 'SALIDA' THEN monto_movimiento_caja ELSE 0 END) as salidas
            ")
            ->where('id_caja', $caja->id_caja)
            ->first();

            $totalIngresos = $totales->ingresos ?? 0;
            $totalSalidas = $totales->salidas ?? 0;

            $montoTeorico = $caja->monto_inicial + $totalIngresos - $totalSalidas;

            $caja->update([
                'fecha_cierre' => now(),
                'monto_final' => $montoTeorico,
                'monto_teorico' => $montoTeorico,
                'monto_real' => $montoTeorico,
                'diferencia' => 0,
                'estado_caja' => 0
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'mensaje' => 'Caja cerrada correctamente',
                'total' => $montoTeorico
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔════════════ Verificar Caja ════════════╗ 
    ╚════════════════════════════════════════╝ */

    public function VerificarCaja()
    {
        $idUsuario = session('usuario.id');

        if (!$idUsuario) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Sesión no válida'
            ], 401);
        }

        $caja = Caja::where('estado_caja', 1)
                    ->where('id_usuario', $idUsuario)
                    ->first();

        return response()->json([
            'abierta' => $caja ? true : false,
            'id_caja' => $caja ? $caja->id_caja : null,
            'usuario' => session('usuario')
        ]);
    }

/*  ╔════════════ Registro Caja ═════════════╗ 
    ╚════════════════════════════════════════╝ */

    public function RegistroCajas()
    {
        try {

            $cajas = Caja::with('usuario')
                ->orderBy('id_caja', 'desc')
                ->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $cajas
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al obtener historial',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

}
