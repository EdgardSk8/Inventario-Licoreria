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
        try {

            $validator = Validator::make($request->all(), [
                'monto_inicial' => 'required|numeric|min:0'
            ], [
                'monto_inicial.required' => 'El monto inicial es obligatorio.',
                'monto_inicial.numeric' => 'El monto inicial debe ser numérico.',
                'monto_inicial.min' => 'El monto inicial no puede ser negativo.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // 🔒 Validar sesión (NO usar auth())
            $idUsuario = session('usuario.id');

            if (!$idUsuario) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Sesión no válida'
                ], 401);
            }

            // 🔎 Verificar si ya hay caja abierta
            $cajaAbierta = Caja::where('estado_caja', 1)
                ->where('id_usuario', $idUsuario)
                ->lockForUpdate()
                ->first();

            if ($cajaAbierta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Ya tienes una caja abierta.'
                ], 400);
            }

            Caja::create([
                'fecha_apertura' => now(),
                'monto_inicial' => $request->monto_inicial,
                'id_usuario' => $idUsuario,
                'estado_caja' => 1
            ]);

            $caja = Caja::latest('id_caja')->first();
            session(['caja_id' => $caja->id_caja]);

            return response()->json([
                'success' => true,
                'mensaje' => 'Caja abierta correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al abrir caja',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔════════════ Cerrar Caja ═════════════╗ 
    ╚══════════════════════════════════════╝ */

    public function CerrarCaja()
    {
        DB::beginTransaction();

        $idUsuario = session('usuario.id');

        if (!$idUsuario) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Sesión no válida'
            ], 401);
        }

        try {

            // 🔥 obtener caja abierta
            $caja = Caja::where('estado_caja', 1)
                ->where('id_usuario', $idUsuario)
                ->first();

            if (!$caja) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'No hay caja abierta'
                ], 400);
            }

            // 💰 total ventas (desde movimientos_caja)
            $totalIngresos = MovimientoCaja::where('id_caja', $caja->id_caja)
                ->where('tipo_movimiento_caja', 'INGRESO')
                ->sum('monto_movimiento_caja');

            $totalSalidas = MovimientoCaja::where('id_caja', $caja->id_caja)
                ->where('tipo_movimiento_caja', 'SALIDA')
                ->sum('monto_movimiento_caja');

            // 🧾 cálculo
            $montoTeorico = $caja->monto_inicial + $totalIngresos - $totalSalidas;

            // 🔒 cerrar caja
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
            ]);
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

    public function RegistroCajas() // Muestra todas las cajas
    {
        try {

            $cajas = Caja::with('usuario')
                ->orderBy('id_caja', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $cajas
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener historial de cajas',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

}
