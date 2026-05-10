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



</head>

<body>

@include('clientes.CheckColumnasClientes') 
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
            <th>Estado</th>
            <th>Acciones</th>

        </tr>
    </thead>

<tbody></tbody>

</table>

</body>
</html>