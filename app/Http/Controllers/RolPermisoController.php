<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Permiso;

class RolPermisoController extends Controller
{
    /**
     * Devuelve TODO estructurado para la vista:
     * roles + permisos + permisos asignados por rol
     */
    public function obtenerRolesPermisos()
    {
        $roles = Rol::with('permisos')->get();
        $permisos = Permiso::all();

        return response()->json([
            'roles' => $roles,
            'permisos' => $permisos
        ]);
    }

    /**
     * Alterna permiso por rol (asignar / quitar)
     */
    public function asignar(Request $request)
    {
        $request->validate([
            'id_rol' => 'required|exists:roles,id_rol',
            'id_permiso' => 'required|exists:permisos,id_permiso',
            'asignar' => 'required|boolean'
        ]);

        $rol = Rol::findOrFail($request->id_rol);

        // 🔥 PROTECCIÓN ADMINISTRADOR
        if ($rol->id_rol == 1 && !$request->asignar) {
            return response()->json([
                'success' => false,
                'mensaje' => 'No se pueden quitar permisos al rol Administrador'
            ], 403);
        }

        if ($request->asignar) {
            $rol->permisos()->syncWithoutDetaching([$request->id_permiso]);
        } else {
            $rol->permisos()->detach($request->id_permiso);
        }

        return response()->json([
            'success' => true,
            'mensaje' => 'Permiso actualizado correctamente'
        ]);
    }



}