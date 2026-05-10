<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrador de Usuarios</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <script src="{{ Vite::asset('resources/js/usuarios/MostrarUsuarios.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/usuarios/BajaUsuario.js') }}"></script>

    <script src="{{ Vite::asset('resources/js/usuarios/CrearUsuario.js') }}"></script>

</head>

<!----------------------------------->
<!-------------- BODY --------------->
<!----------------------------------->

<body>
        
    @include('usuarios.CheckColumnasUsuarios')
    @include('usuarios.CrearUsuario') {{-- MODAL CREAR USUARIO --}}
    @include('usuarios.EditarUsuario') {{-- MODAL EDITAR USUARIO --}}

    <table id="tablaUsuarios" class="table table-striped table-bordered">

        <thead>

            <tr>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
            </tr>

        </thead>

        <tbody></tbody>

    </table>

</body>
</html>