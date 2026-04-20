<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Cuentas</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

<!-- JS CUENTAS -->
<script src="{{ Vite::asset('resources/js/cuentas/MostrarCuentas.js') }}"></script>
<script src="{{ Vite::asset('resources/js/cuentas/BajaCuentas.js') }}"></script>
<script src="{{ Vite::asset('resources/js/cuentas/CrearCuentas.js') }}"></script>

<!-- TOAST -->
<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>
    <!-- Botón Agregar Cuenta -->
        <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearCuenta">
            <i class="bi bi-plus-circle me-1"></i> Agregar Cuenta
        </button>

        <!-- Botón Transferir entre cuentas -->
        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearCuenta">
            <i class="bi bi-arrow-left-right me-1"></i> Transferir entre cuentas
        </button>

    </div>

    <!-- Toggle ocultar inactivos -->
    <div class="form-check form-switch mb-0">
        <input class="form-check-input" type="checkbox" id="toggleInactivosCuentas" checked>
        <label class="form-check-label" for="toggleInactivosCuentas">
            Ocultar inactivos
        </label>
    </div>

</div>

{{-- MODALES --}}
@include('cuentas.CrearCuenta')
@include('cuentas.EditarCuenta')

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