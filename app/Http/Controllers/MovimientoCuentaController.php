<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoCuenta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\Cuenta;

class MovimientoCuentaController extends Controller
{
    
    public function MostrarMovimientosCuenta()
        {
        try {

            $movimientos = MovimientoCuenta::select(
                    'movimientos_cuentas.id_movimiento_cuenta',
                    'movimientos_cuentas.id_cuenta',
                    'cuentas.nombre_cuenta',
                    'movimientos_cuentas.tipo_movimiento',
                    'movimientos_cuentas.monto',
                    'movimientos_cuentas.descripcion',
                    'movimientos_cuentas.id_transferencia',
                    'movimientos_cuentas.fecha',
                    'movimientos_cuentas.id_usuario',
                    'usuarios.nombre_completo_usuario'
                )
                ->join('cuentas', 'movimientos_cuentas.id_cuenta', '=', 'cuentas.id_cuenta')
                ->join('usuarios', 'movimientos_cuentas.id_usuario', '=', 'usuarios.id_usuario')
                ->orderBy('movimientos_cuentas.fecha', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'movimientos' => $movimientos
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener movimientos de cuentas',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }


    public function MovimientoCuenta(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id_cuenta' => 'required|exists:cuentas,id_cuenta',
                'tipo_movimiento' => 'required|in:AGREGAR,RETIRAR',
                'monto' => 'required|numeric|min:0.01',
                'descripcion' => 'nullable|max:150'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $idUsuario = session('usuario.id');

            if (!$idUsuario) {
                throw new \Exception('Sesión no válida');
            }

            $resultado = DB::transaction(function () use ($request, $idUsuario) {

                $cuenta = Cuenta::lockForUpdate()->find($request->id_cuenta);

                if (!$cuenta) {
                    throw new \Exception('Cuenta no encontrada', 404);
                }

                $monto = (float) $request->monto;

                if ($request->tipo_movimiento === 'RETIRAR' && $monto > $cuenta->saldo_actual) {
                    throw new \Exception('Saldo insuficiente', 400);
                }

                $tipoReal = $request->tipo_movimiento === 'AGREGAR'
                    ? 'INGRESO'
                    : 'SALIDA';

                $descripcion = trim($request->descripcion);

                if (!$descripcion) {
                    $descripcion = $tipoReal === 'INGRESO'
                        ? 'Ingreso de dinero'
                        : 'Salida de dinero';
                }

                MovimientoCuenta::create([
                    'id_cuenta' => $cuenta->id_cuenta,
                    'tipo_movimiento' => $tipoReal,
                    'descripcion' => $descripcion,
                    'monto' => $monto,
                    'fecha' => now(),
                    'id_usuario' => $idUsuario,
                    'id_transferencia' => null
                ]);

                if ($tipoReal === 'INGRESO') {
                    $cuenta->saldo_actual += $monto;
                } else {
                    $cuenta->saldo_actual -= $monto;
                }

                $cuenta->save();

                return [
                    'success' => true,
                    'mensaje' => 'Movimiento realizado correctamente',
                    'saldo_actual' => $cuenta->saldo_actual
                ];
            });

            return response()->json($resultado, 200);

        } catch (\Exception $e) {

            $code = $e->getCode();
            $status = ($code >= 400 && $code < 600) ? $code : 500;

            return response()->json([
                'success' => false,
                'mensaje' => $e->getMessage()
            ], $status);
        }
    }

}
