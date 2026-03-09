<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador de Usuarios</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">
<link rel="stylesheet" href="{{ Vite::asset('resources/css/usuarios/TablaUsuarios.css') }}">

<script src="{{ Vite::asset('resources/js/usuarios/MostrarUsuarios.js') }}"></script>
<script src="{{ Vite::asset('resources/js/usuarios/BajaUsuario.js') }}"></script>
<script src="{{ Vite::asset('resources/js/usuarios/MensajeToast.js') }}"></script>
<script src="{{ Vite::asset('resources/js/usuarios/CrearUsuario.js') }}"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery (DataTables lo necesita) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<!-- DataTables Bootstrap -->
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<!-- Botones de exportación -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>

<!-- Exportar Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

</head>

<!----------------------------------->
<!-------------- BODY --------------->
<!----------------------------------->

<body>

<button  type="button" class="btn btn-sm btn-agregar_usuario" style="background:#1f2937; color: white;" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario"> + Agregar Usuario </button>

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