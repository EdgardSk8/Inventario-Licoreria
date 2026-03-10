<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Métodos de Pago</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

<script src="{{ Vite::asset('resources/js/metodos_pago/MostrarMetodoPago.js') }}"></script>
<script src="{{ Vite::asset('resources/js/metodos_pago/BajaMetodoPago.js') }}"></script>
<script src="{{ Vite::asset('resources/js/metodos_pago/CrearMetodoPago.js') }}"></script>

<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- Botón Agregar Método de Pago -->

    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearMetodoPago">
        + Agregar Método de Pago
    </button>

    <!-- Checkbox para ocultar inactivos -->

    <div class="form-check form-switch mb-0">
        <input class="form-check-input" type="checkbox" id="toggleInactivosMetodosPago" checked>
        <label class="form-check-label" for="toggleInactivosMetodosPago">
            Ocultar inactivos
        </label>
    </div>

</div>

@include('metodos_pago.CrearMetodoPago') {{-- MODAL CREAR --}}
@include('metodos_pago.EditarMetodoPago') {{-- MODAL EDITAR --}}

<table id="tablaMetodosPago" class="table table-striped table-bordered">

<thead>
<tr>
    <th>Nombre del Método</th>
    <th>Descripción</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>
</thead>

<tbody></tbody>

</table>

</body>
</html>