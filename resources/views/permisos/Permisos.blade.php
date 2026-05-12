<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles y Permisos</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/permisos/Permisos.css') }}">
    <script src="{{ Vite::asset('resources/js/permisos/PermisosRoles.js') }}"></script>

    

</head>

<body>

<div class="card shadow-sm border-0 padre-permisos">

    <div class="dropdown">
        
        <select id="selectRol" class="Selector-Rol">
            <option value="">Seleccione un rol</option>
        </select>
            
    </div>

    <div class="hijo-permisos">

        <div id="contenedorPermisos">
            <!-- JS genera acordeones por módulo -->
        </div>

    </div>

</div>

<!-- Toast -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="toastMensaje" class="toast text-bg-success border-0">
        <div class="d-flex">
            <div class="toast-body" id="toastTexto"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>


</body>
</html>