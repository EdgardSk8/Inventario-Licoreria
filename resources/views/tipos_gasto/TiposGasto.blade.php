<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Tipos de Gasto</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

<script src="{{ Vite::asset('resources/js/tipos_gasto/MostrarTipoGasto.js') }}"></script>
<script src="{{ Vite::asset('resources/js/tipos_gasto/BajaTipoGasto.js') }}"></script>
<script src="{{ Vite::asset('resources/js/tipos_gasto/CrearTipoGasto.js') }}"></script>

<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- Botón Agregar Tipo de Gasto -->

    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearTipoGasto">
        + Agregar Tipo de Gasto
    </button>

    <!-- Checkbox para ocultar inactivos -->
    <div class="form-check form-switch mb-0">
        <input class="form-check-input" type="checkbox" id="toggleInactivosTipoGasto" checked>
        <label class="form-check-label" for="toggleInactivosTipoGasto">Ocultar inactivos</label>
    </div>

</div>

@include('tipos_gasto.CrearTipoGasto') {{-- MODAL CREAR --}}
@include('tipos_gasto.EditarTipoGasto') {{-- MODAL EDITAR --}}

<table id="tablaTipoGasto" class="table table-striped table-bordered">

    <thead>
        <tr>
            <th>Nombre del Tipo de Gasto</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody></tbody>

</table>

</body>
</html>