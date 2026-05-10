<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrador de Tipos de Gasto</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <script src="{{ Vite::asset('resources/js/tipos_gasto/MostrarTipoGasto.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/tipos_gasto/BajaTipoGasto.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/tipos_gasto/CrearTipoGasto.js') }}"></script>

</head>

<body>

    @include('tipos_gasto.CheckColumnasTipoGasto')
    @include('tipos_gasto.CrearTipoGasto') {{-- MODAL CREAR --}}
    @include('tipos_gasto.EditarTipoGasto') {{-- MODAL EDITAR --}}

    <table id="tablaTipoGasto" class="table table-striped table-bordered">

        <thead>
            <tr>
                <th>Nombre del Tipo de Gasto</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

</body>
</html>