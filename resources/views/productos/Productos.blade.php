<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Productos</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

<!-- JS -->
<script src="{{ Vite::asset('resources/js/productos/MostrarProducto.js') }}"></script>
<script src="{{ Vite::asset('resources/js/productos/BajaProducto.js') }}"></script>
<script src="{{ Vite::asset('resources/js/productos/CrearProducto.js') }}"></script>
<script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>

<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- Botón Agregar Producto -->
    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearProducto">
        + Agregar Producto
    </button>

    <!-- Checkbox ocultar inactivos -->
    <div class="form-check form-switch mb-0">
        <input class="form-check-input" type="checkbox" id="toggleInactivosProductos" checked>
        <label class="form-check-label" for="toggleInactivosProductos">Ocultar inactivos</label>
    </div>

</div>

{{-- MODALES --}}
@include('productos.CrearProducto')
@include('productos.EditarProducto')
@include('productos.DetalleProducto')

<table id="tablaProductos" class="table table-striped table-bordered">

    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody></tbody>

</table>

</body>
</html>