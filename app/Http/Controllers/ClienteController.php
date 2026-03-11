<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;

class ClienteController extends Controller
{

/*  ╔════════════ Crear Cliente ═════════════╗ 
    ╚════════════════════════════════════════╝ */

    public function CrearCliente(Request $request)
    {
        try {

            $validator = Validator::make(
                [
                    'nombre_cliente' => $request->nombre_cliente,
                    'cedula_cliente' => $request->cedula_cliente,
                    'ruc_cliente' => $request->ruc_cliente,
                    'telefono_cliente' => $request->telefono_cliente,
                    'direccion_cliente' => $request->direccion_cliente,
                    'correo_cliente' => $request->correo_cliente,
                ],
                [
                    'nombre_cliente' => [
                        'required',
                        'max:150'
                    ],
                    'cedula_cliente' => [
                        'nullable',
                        'unique:clientes,cedula_cliente',
                        'max:16'
                    ],
                    'ruc_cliente' => [
                        'nullable',
                        'unique:clientes,ruc_cliente',
                        'max:20'
                    ],
                    'telefono_cliente' => [
                        'nullable',
                        'max:20'
                    ],
                    'direccion_cliente' => [
                        'nullable',
                        'max:200'
                    ],
                    'correo_cliente' => [
                        'nullable',
                        'email',
                        'max:100'
                    ]
                ],
                [
                    'nombre_cliente.required' => 'El nombre del cliente es obligatorio.',
                    'nombre_cliente.max' => 'El nombre no puede exceder 150 caracteres.',

                    'cedula_cliente.unique' => 'Ya existe un cliente con esta cédula.',
                    'cedula_cliente.max' => 'La cédula no puede exceder 16 caracteres.',

                    'ruc_cliente.unique' => 'Ya existe un cliente con este RUC.',
                    'ruc_cliente.max' => 'El RUC no puede exceder 20 caracteres.',

                    'correo_cliente.email' => 'Debe ingresar un correo válido.',
                    'correo_cliente.max' => 'El correo no puede exceder 100 caracteres.'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            Cliente::create([
                'nombre_cliente' => $request->nombre_cliente,
                'cedula_cliente' => $request->cedula_cliente,
                'ruc_cliente' => $request->ruc_cliente,
                'telefono_cliente' => $request->telefono_cliente,
                'direccion_cliente' => $request->direccion_cliente,
                'correo_cliente' => $request->correo_cliente,
                'estado_cliente' => true
            ]);

            return response()->json([
                'success' => true,
                'mensaje' => 'Cliente creado correctamente'
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al crear cliente',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }

/*  ╔════════════ Editar Cliente ═════════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function EditarCliente($id)
    {
        try {

            $cliente = Cliente::find($id);

            if (!$cliente) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Cliente no encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'cliente' => $cliente
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener cliente',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }

/*  ╔═══════════ Actualizar Cliente ═══════════╗ 
    ╚══════════════════════════════════════════╝ */

    public function ActualizarCliente(Request $request, $id)
    {
        try {

            $cliente = Cliente::find($id);

            if (!$cliente) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Cliente no encontrado'
                ], 404);
            }

            $validator = Validator::make(
                [
                    'nombre_cliente' => $request->nombre_cliente,
                    'cedula_cliente' => $request->cedula_cliente,
                    'ruc_cliente' => $request->ruc_cliente,
                    'telefono_cliente' => $request->telefono_cliente,
                    'direccion_cliente' => $request->direccion_cliente,
                    'correo_cliente' => $request->correo_cliente,
                    'estado_cliente' => $request->estado_cliente
                ],
                [
                    'nombre_cliente' => [
                        'required',
                        'max:150'
                    ],
                    'cedula_cliente' => [
                        'nullable',
                        "unique:clientes,cedula_cliente,$id,id_cliente",
                        'max:16'
                    ],
                    'ruc_cliente' => [
                        'nullable',
                        "unique:clientes,ruc_cliente,$id,id_cliente",
                        'max:20'
                    ],
                    'telefono_cliente' => [
                        'nullable',
                        'max:20'
                    ],
                    'direccion_cliente' => [
                        'nullable',
                        'max:200'
                    ],
                    'correo_cliente' => [
                        'nullable',
                        'email',
                        'max:100'
                    ],
                    'estado_cliente' => [
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

            $cliente->nombre_cliente = $request->nombre_cliente;
            $cliente->cedula_cliente = $request->cedula_cliente;
            $cliente->ruc_cliente = $request->ruc_cliente;
            $cliente->telefono_cliente = $request->telefono_cliente;
            $cliente->direccion_cliente = $request->direccion_cliente;
            $cliente->correo_cliente = $request->correo_cliente;
            $cliente->estado_cliente = $request->estado_cliente;

            $cliente->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Cliente actualizado correctamente'
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al actualizar cliente',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }

/*  ╔═══════════ Cambiar Estado Cliente ═════════╗ 
    ╚════════════════════════════════════════════╝ */

    public function CambiarEstadoCliente($id){
        try {

            $cliente = Cliente::find($id);

            if (!$cliente) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Cliente no encontrado'
                ], 404);
            }

            $cliente->estado_cliente = !$cliente->estado_cliente;
            $cliente->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Estado del cliente actualizado'
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al cambiar estado del cliente',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }

/*  ╔═══════════ Mostrar Clientes ════════════╗ 
    ╚═════════════════════════════════════════╝ */

    public function MostrarClientes(){
        try {

            $clientes = Cliente::all();

            return response()->json([
                'success' => true,
                'clientes' => $clientes
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener clientes',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }

} // Fin de controlador
