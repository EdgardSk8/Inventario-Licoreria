<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Clientes</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

<script src="{{ Vite::asset('resources/js/clientes/MostrarCliente.js') }}"></script>
<script src="{{ Vite::asset('resources/js/clientes/BajaCliente.js') }}"></script>
<script src="{{ Vite::asset('resources/js/clientes/CrearCliente.js') }}"></script>

<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- Botón Agregar Cliente -->

    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearCliente">
        + Agregar Cliente
    </button>

    <!-- Checkbox ocultar inactivos -->

    <div class="form-check form-switch mb-0">
        <input class="form-check-input" type="checkbox" id="toggleInactivosClientes" checked>
        <label class="form-check-label" for="toggleInactivosClientes">Ocultar inactivos</label>
    </div>

</div>

@include('clientes.CrearCliente') {{-- MODAL CREAR CLIENTE --}}
@include('clientes.EditarCliente') {{-- MODAL EDITAR CLIENTE --}}

<table id="tablaClientes" class="table table-striped table-bordered">

<thead>
<tr>

<th>Nombre</th>
<th>Cédula</th>
<th>RUC</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Fecha Creación</th>
<th>Estado</th>
<th>Acciones</th>

</tr>
</thead>

<tbody></tbody>

</table>

</body>
</html>