<!DOCTYPE html>

<html lang="es">

<!-- ═════════════════════════ (HEAD - CONFIGURACIÓN GENERAL) ═════════════════════════ -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Cuentas</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ═══════════════════════════ ESTILOS (CSS) ═══════════════════════════ -->

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <!-- ═══════════════════════════ SCRIPTS (JS) ═══════════════════════════ -->

    <script src="{{ Vite::asset('resources/js/cuentas/MostrarCuentas.js') }}"></script> 
    <script src="{{ Vite::asset('resources/js/cuentas/BajaCuentas.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/cuentas/CrearCuentas.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/cuentas/TransferirCuentas.js') }}"></script>

    <!-- 🔹 Sistema de notificaciones (Toast) -->
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<!-- ═════════════════════════ (BODY - INTERFAZ DE USUARIO) ═════════════════════════ -->

<body>

    <!-- ════════════ ACCIONES PRINCIPALES ════════════ -->

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <!-- Crear nueva cuenta -->
            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearCuenta">
                <i class="bi bi-plus-circle me-1"></i> Agregar Cuenta
            </button>

            <!-- Transferir saldo entre cuentas -->
            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ModalTransferirCuenta">
                <i class="bi bi-arrow-left-right me-1"></i> Transferir entre cuentas
            </button>

        </div>

        <!-- Filtro visual: ocultar cuentas inactivas -->
        <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" id="toggleInactivosCuentas" checked>
            <label class="form-check-label" for="toggleInactivosCuentas">
                Ocultar inactivos
            </label>
        </div>

    </div>

    <!-- ════════════ MODALES ════════════ -->

    @include('cuentas.CrearCuenta')
    @include('cuentas.EditarCuenta')
    @include('cuentas.TransferirCuenta')

    <!-- ════════════ TABLA DE CUENTAS ════════════ -->

    <table id="tablaCuentas" class="table table-striped table-bordered">

        <thead>
            <tr>
                <th>Nombre Cuenta</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Saldo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

</body>
</html>