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
<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>
<script src="{{ Vite::asset('resources/js/usuarios/CrearUsuario.js') }}"></script>



</head>

<!----------------------------------->
<!-------------- BODY --------------->
<!----------------------------------->

<body>

<div class="d-flex justify-content-between align-items-center mb-3">
    <!-- Botón Agregar Usuario -->
    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
        + Agregar Usuario
    </button>

    <!-- Checkbox para ocultar inactivos -->
    <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" id="toggleInactivosUsuarios" checked>
            <label class="form-check-label" for="toggleInactivosUsuarios">Ocultar inactivos</label>
        </div>
    </div>

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