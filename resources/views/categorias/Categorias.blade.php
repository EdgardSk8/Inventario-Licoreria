<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Categorías</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

<script src="{{ Vite::asset('resources/js/categorias/MostrarCategoria.js') }}"></script>
<script src="{{ Vite::asset('resources/js/categorias/BajaCategoria.js') }}"></script>
<script src="{{ Vite::asset('resources/js/categorias/CrearCategoria.js') }}"></script>

<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- Botón Agregar Categoria -->

    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearCategoria">
        + Agregar Categoría
    </button>

    <!-- Checkbox para ocultar inactivos -->

    <div class="form-check form-switch mb-0">
        <input class="form-check-input" type="checkbox" id="toggleInactivosCategorias" checked>
        <label class="form-check-label" for="toggleInactivosCategorias">Ocultar inactivos</label>
    </div>

</div>

@include('categorias.CrearCategoria') {{-- MODAL CREAR CATEGORIA --}}
@include('categorias.EditarCategoria') {{-- MODAL EDITAR CATEGORIA --}}

<table id="tablaCategorias" class="table table-striped table-bordered">

    <thead>
        <tr>
            <th>Nombre de la Categoría</th>
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