<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Caja;

class CajaController extends Controller
{

/*  ╔════════════ Abrir Caja ═════════════╗ 
    ╚═════════════════════════════════════╝ */
    
    public function AbrirCaja(Request $request)
    {
        try {

            $validator = Validator::make(
                [
                    'monto_inicial' => $request->monto_inicial
                ],
                [
                    'monto_inicial' => [
                        'required',
                        'numeric',
                        'min:0'
                    ]
                ],
                [
                    'monto_inicial.required' => 'El monto inicial es obligatorio.',
                    'monto_inicial.numeric' => 'El monto inicial debe ser numérico.',
                    'monto_inicial.min' => 'El monto inicial no puede ser negativo.'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $cajaAbierta = Caja::where('estado_caja', true)->first();

            if ($cajaAbierta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Ya existe una caja abierta.'
                ], 400);
            }

            Caja::create([
                'monto_inicial' => $request->monto_inicial,
                'id_usuario' => auth()->id(),
                'estado_caja' => true
            ]);

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

    public function CerrarCaja(Request $request)
    {
        try {

            $validator = Validator::make(
                [
                    'monto_final' => $request->monto_final
                ],
                [
                    'monto_final' => [
                        'required',
                        'numeric',
                        'min:0'
                    ]
                ],
                [
                    'monto_final.required' => 'El monto final es obligatorio.',
                    'monto_final.numeric' => 'El monto final debe ser numérico.',
                    'monto_final.min' => 'El monto final no puede ser negativo.'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $caja = Caja::where('estado_caja', true)->first();

            if (!$caja) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'No hay caja abierta'
                ], 404);
            }

            $caja->update([
                'monto_final' => $request->monto_final,
                'fecha_cierre' => now(),
                'estado_caja' => false
            ]);

            return response()->json([
                'success' => true,
                'mensaje' => 'Caja cerrada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al cerrar caja',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔════════════ Registro Caja ═════════════╗ 
    ╚════════════════════════════════════════╝ */

    public function RegistroCajas()
    {
        try {

            $cajas = Caja::with('usuario')
                ->orderBy('fecha_apertura', 'desc')
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
