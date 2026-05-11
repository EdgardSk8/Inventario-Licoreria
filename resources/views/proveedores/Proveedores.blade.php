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



</head>

<body>

@include('proveedores.CheckColumnasProveedor')
@include('proveedores.CrearProveedor') {{-- MODAL CREAR --}}
@include('proveedores.EditarProveedor') {{-- MODAL EDITAR --}}


<table id="tablaProveedores" class="table table-striped table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>RUC</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <!-- <th>Fecha de Creación</th> -->
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody></tbody>

</table>

</body>
</html>