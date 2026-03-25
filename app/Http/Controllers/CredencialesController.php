<?php

namespace App\Http\Controllers;

use App\Models\Credenciales;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CredencialesController extends Controller
{

/*  ╔═════════════ Mostrar Credenciales ══════════════╗ 
    ╚═════════════════════════════════════════════════╝ */

    public function MostrarCredenciales()
    {
        try {
            $config = Credenciales::first();

            return response()->json([
                'success' => true,
                'data' => $config
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener configuración',
                'error' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔══════════════ Editar Credenciales ══════════════╗ 
    ╚═════════════════════════════════════════════════╝ */

    public function EditarCredencial($id)
    {
        try {
            $credenciales = Credenciales::find($id);

            if (!$credenciales) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Credenciales no encontradas'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'credenciales' => $credenciales
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener credenciales',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


/*  ╔═══════════ Actualizar Credenciales ═══════════╗ 
    ╚═══════════════════════════════════════════════╝ */

    public function ActualizarCredenciales(Request $request, $id)
    {
        try {
            $credenciales = Credenciales::find($id);

            if (!$credenciales) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Credenciales no encontradas'
                ], 404);
            }

            $validator = Validator::make(
                [
                    'nombre_empresa' => $request->nombre_empresa,
                    'ruc_empresa' => $request->ruc_empresa,
                    'direccion_empresa' => $request->direccion_empresa,
                    'telefono_empresa' => $request->telefono_empresa,
                    'correo_empresa' => $request->correo_empresa
                ],
                [
                    'nombre_empresa' => ['required', 'max:100'],
                    'ruc_empresa' => ['required', 'max:20'],
                    'direccion_empresa' => ['required', 'max:255'],
                    'telefono_empresa' => ['required', 'max:20'],
                    'correo_empresa' => ['required', 'email', 'max:100']
                ],
                [
                    'nombre_empresa.required' => 'El nombre de la empresa es obligatorio.',
                    'ruc_empresa.required' => 'El RUC es obligatorio.',
                    'direccion_empresa.required' => 'La dirección es obligatoria.',
                    'telefono_empresa.required' => 'El teléfono es obligatorio.',
                    'correo_empresa.required' => 'El correo es obligatorio.',
                    'correo_empresa.email' => 'El correo no es válido.'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $credenciales->nombre_empresa = $request->nombre_empresa;
            $credenciales->ruc_empresa = $request->ruc_empresa;
            $credenciales->direccion_empresa = $request->direccion_empresa;
            $credenciales->telefono_empresa = $request->telefono_empresa;
            $credenciales->correo_empresa = $request->correo_empresa;

            $credenciales->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Credenciales actualizadas correctamente',
                'credenciales' => $credenciales
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al actualizar credenciales',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }








}
