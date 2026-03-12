<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Proveedores</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

<script src="{{ Vite::asset('resources/js/proveedores/MostrarProveedor.js') }}"></script>
<script src="{{ Vite::asset('resources/js/proveedores/BajaProveedor.js') }}"></script>
<script src="{{ Vite::asset('resources/js/proveedores/CrearProveedor.js') }}"></script>

<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- Botón Agregar Proveedor -->

    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearProveedor">
        + Agregar Proveedor
    </button>

    <!-- Checkbox para ocultar inactivos -->

    <div class="form-check form-switch mb-0">
        <input class="form-check-input" type="checkbox" id="toggleInactivosProveedores" checked>
        <label class="form-check-label" for="toggleInactivosProveedores">
            Ocultar inactivos
        </label>
    </div>

</div>

@include('proveedores.CrearProveedor') {{-- MODAL CREAR --}}
@include('proveedores.EditarProveedor') {{-- MODAL EDITAR --}}

<table id="tablaProveedores" class="table table-striped table-bordered">

    <thead>
        <tr>
            <th>Nombre</th>
            <th>RUC</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Fecha de Creación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody></tbody>

</table>

</body>
</html>