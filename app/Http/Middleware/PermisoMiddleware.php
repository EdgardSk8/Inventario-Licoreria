<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class PermisoMiddleware
{
    public function handle(Request $request, Closure $next, $permiso): Response
    {
        $usuario = session('usuario');

        if (!$usuario) {
            return response()->view('errors.sin_permiso', [], 401);
        }

        $tienePermiso = DB::table('rol_permiso')
            ->join('permisos', 'rol_permiso.id_permiso', '=', 'permisos.id_permiso')
            ->where('rol_permiso.id_rol', $usuario['id_rol'])
            ->where('permisos.nombre_permiso', $permiso)
            ->where('permisos.estado_permiso', 1)
            ->exists();

        if (!$tienePermiso) {
            return redirect()->route('error');
        }

        return $next($request);
    }


}