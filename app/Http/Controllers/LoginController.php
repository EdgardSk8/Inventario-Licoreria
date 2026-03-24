<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Usuario;

class LoginController extends Controller
{
    
/*  ╔════════════ LOGIN ═════════════╗ 
    ╚════════════════════════════════╝ */

    public function login(Request $request)
    {
        try {

            // ✅ Validación
            $validator = Validator::make($request->all(), [
                'nombre_usuario' => 'required',
                'password' => 'required'
            ], [
                'nombre_usuario.required' => 'El usuario es obligatorio.',
                'password.required' => 'La contraseña es obligatoria.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // 🔎 Buscar usuario + rol
            $usuario = Usuario::select(
                    'usuarios.*',
                    'roles.nombre_rol'
                )
                ->join('roles', 'usuarios.id_rol_usuario', '=', 'roles.id_rol')
                ->where('nombre_usuario', $request->nombre_usuario)
                ->first();

            // ❌ Usuario no existe
            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Usuario o contraseña incorrectos'
                ], 401);
            }

            // ❌ Usuario inactivo
            if (!$usuario->estado_usuario) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Usuario inactivo'
                ], 403);
            }

            // 🔐 Verificar contraseña
            if (!Hash::check($request->password, $usuario->password_hash_usuario)) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Usuario o contraseña incorrectos'
                ], 401);
            }

            // ✅ Guardar sesión
            Session::put('usuario', [
                'id' => $usuario->id_usuario,
                'nombre' => $usuario->nombre_usuario,
                'id_rol' => $usuario->id_rol_usuario,
                'rol' => $usuario->nombre_rol
            ]);

            return response()->json([
                'success' => true,
                'mensaje' => 'Login correcto',
                'usuario' => [
                    'nombre' => $usuario->nombre_usuario,
                    'rol' => $usuario->nombre_rol
                ]
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error en el login',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔════════════ LOGOUT ═════════════╗ 
    ╚═════════════════════════════════╝ */

    public function logout()
    {
        session()->forget('usuario');
        session()->flush(); // limpia toda la sesión

        return response()->json([
            'success' => true,
            'mensaje' => 'Sesión cerrada correctamente'
        ]);
}
}
