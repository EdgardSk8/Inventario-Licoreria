<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Rol;


class RolController extends Controller
{
    public function MostrarRoles(Request $request)
    {
        try {

            // Validar parámetros opcionales
            $validator = Validator::make($request->all(), [
                'estado' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'mensajes' => $validator->errors()
                ], 400);
            }

            // Consulta base
            $query = Rol::query();

            // Filtrar por estado si se envía
            if ($request->has('estado')) {
                $query->where('estado_rol', $request->estado);
            }

            $roles = $query->orderBy('id_rol', 'asc')->get();

            return response()->json([
                'success' => true,
                'total' => $roles->count(),
                'data' => $roles
            ], 200);

        } catch (\Exception $e) {

            // Depuración
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener los roles',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
}
