<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Roles</title>


<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

<script src="{{ Vite::asset('resources/js/roles/MostrarRoles.js') }}"></script>
<script src="{{ Vite::asset('resources/js/roles/BajaRol.js') }}"></script>
<script src="{{ Vite::asset('resources/js/roles/CrearRol.js') }}"></script>
<script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>



<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>
</head>

<body>

<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- Botón Agregar Rol -->

    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearRol">
        + Agregar Rol
    </button>

    <!-- Checkbox para ocultar inactivos -->
    <div class="form-check form-switch mb-0">
        <input class="form-check-input" type="checkbox" id="toggleInactivosRoles" checked>
        <label class="form-check-label" for="toggleInactivos">Ocultar inactivos</label>
    </div>

</div>

@include('roles.CrearRol') {{-- MODAL CREAR ROL --}}
@include('roles.EditarRol') {{-- MODAL EDITAR ROL --}}

<table id="tablaRoles" class="table table-striped table-bordered">

    <thead>
        <tr>
            <th>Nombre del Rol</th>
            <th>Descripción</th>
            <th>Fecha de Creación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody></tbody>

</table>

</body>
</html>