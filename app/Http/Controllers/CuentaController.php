<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cuenta;

class CuentaController extends Controller
{

/*  ╔═════════════ Crear Cuenta ══════════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function CrearCuenta(Request $request)
    {
        try {

            $validator = Validator::make(
                [
                    'nombre_cuenta' => $request->nombre_cuenta,
                    'tipo_cuenta' => $request->tipo_cuenta,
                    'descripcion' => $request->descripcion,
                    'saldo_actual' => $request->saldo_actual,
                ],
                [
                    'nombre_cuenta' => [
                        'required',
                        'unique:cuentas,nombre_cuenta',
                        'max:100'
                    ],
                    'tipo_cuenta' => [
                        'required',
                        'max:50'
                    ],
                    'descripcion' => [
                        'nullable',
                        'max:150'
                    ],
                    'saldo_actual' => [
                        'required',
                        'numeric',
                        'min:0'
                    ]
                ],
                [
                    'nombre_cuenta.required' => 'El nombre de la cuenta es obligatorio.',
                    'nombre_cuenta.unique' => 'Ya existe una cuenta con ese nombre.',
                    'saldo_actual.numeric' => 'El saldo debe ser numérico.',
                    'saldo_actual.min' => 'El saldo no puede ser negativo.'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            Cuenta::create([
                'nombre_cuenta' => $request->nombre_cuenta,
                'tipo_cuenta' => $request->tipo_cuenta,
                'descripcion' => $request->descripcion,
                'saldo_actual' => $request->saldo_actual,
                'estado' => true
            ]);

            return response()->json([
                'success' => true,
                'mensaje' => 'Cuenta creada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al crear cuenta',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


/*  ╔═════════════ Editar Cuenta ══════════════╗ 
    ╚══════════════════════════════════════════╝ */

    public function EditarCuenta($id)
    {
        try {

            $cuenta = Cuenta::find($id);

            if (!$cuenta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Cuenta no encontrada'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'cuenta' => $cuenta
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener cuenta',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


/*  ╔═══════════ Actualizar Cuenta ═══════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function ActualizarCuenta(Request $request, $id)
    {
        try {

            $cuenta = Cuenta::find($id);

            if (!$cuenta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Cuenta no encontrada'
                ], 404);
            }

            $validator = Validator::make(
                [
                    'nombre_cuenta' => $request->nombre_cuenta,
                    'tipo_cuenta' => $request->tipo_cuenta,
                    'descripcion' => $request->descripcion,
                    'saldo_actual' => $request->saldo_actual,
                    'estado' => $request->estado
                ],
                [
                    'nombre_cuenta' => [
                        'required',
                        "unique:cuentas,nombre_cuenta,$id,id_cuenta",
                        'max:100'
                    ],
                    'tipo_cuenta' => [
                        'required',
                        'max:50'
                    ],
                    'descripcion' => [
                        'nullable',
                        'max:150'
                    ],
                    'saldo_actual' => [
                        'required',
                        'numeric',
                        'min:0'
                    ],
                    'estado' => [
                        'required',
                        'boolean'
                    ]
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $cuenta->nombre_cuenta = $request->nombre_cuenta;
            $cuenta->tipo_cuenta = $request->tipo_cuenta;
            $cuenta->descripcion = $request->descripcion;
            //$cuenta->saldo_actual = $request->saldo_actual;
            $cuenta->estado = $request->estado;
            $cuenta->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Cuenta actualizada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al actualizar cuenta',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


/*  ╔═══════════ Cambiar Estado Cuenta ═════════╗ 
    ╚═══════════════════════════════════════════╝ */

    public function CambiarEstadoCuenta($id)
    {
        try {

            $cuenta = Cuenta::find($id);

            if (!$cuenta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Cuenta no encontrada'
                ], 404);
            }

            $cuenta->estado = !$cuenta->estado;
            $cuenta->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Estado de la cuenta actualizado'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al cambiar estado',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


/*  ╔═══════════ Mostrar Cuentas ════════════╗ 
    ╚════════════════════════════════════════╝ */

    public function MostrarCuentas()
    {
        try {

            $cuentas = Cuenta::all();

            return response()->json([
                'success' => true,
                'cuentas' => $cuentas
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener cuentas',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
    

}