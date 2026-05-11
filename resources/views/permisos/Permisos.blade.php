<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles y Permisos</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <script src="{{ Vite::asset('resources/js/permisos/PermisosRoles.js') }}"></script>


</head>

<body class="bg-light">

<div class="container-fluid py-3">

    <!-- HEADER -->
    <div class="card shadow-sm border-0 mb-3">

        <div class="card-body d-flex justify-content-between align-items-center">

            <h5 class="mb-0 fw-bold">Gestión de Permisos por Rol</h5>

            <select id="selectRol" class="form-select w-auto">
                <option value="">Seleccione un rol</option>
            </select>

        </div>

    </div>

    <!-- PERMISOS -->
    <div class="card shadow-sm border-0">

        <div class="card-body p-2">

            <div id="contenedorPermisos" class="accordion"
                 style="max-height: 75vh; overflow-y: auto;">

                <!-- JS genera acordeones por módulo -->

            </div>

        </div>

    </div>

</div>

<!-- ╔════════ Toast ═════════╗ -->
<div class="toast-container position-fixed top-0 end-0 p-3">

    <div id="toastMensaje" class="toast text-bg-success border-0">

        <div class="d-flex">

            <div class="toast-body" id="toastTexto"></div>

            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>