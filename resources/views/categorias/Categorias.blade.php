<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrador de Categorías</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ Vite::asset('resources/js/categorias/MostrarCategoria.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/categorias/BajaCategoria.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/categorias/CrearCategoria.js') }}"></script>

</head>

<body>

    @include('categorias.CheckColumnasCategorias')
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