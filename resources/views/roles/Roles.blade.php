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

</head>

<body>

    @include('roles.CheckColumnasRoles')
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