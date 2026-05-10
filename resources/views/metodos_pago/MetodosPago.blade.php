<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrador de Métodos de Pago</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <script src="{{ Vite::asset('resources/js/metodos_pago/MostrarMetodoPago.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/metodos_pago/BajaMetodoPago.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/metodos_pago/CrearMetodoPago.js') }}"></script>

</head>

    @include('metodos_pago.CheckColumnasMetodosPago')
    @include('metodos_pago.CrearMetodoPago') {{-- MODAL CREAR --}}
    @include('metodos_pago.EditarMetodoPago') {{-- MODAL EDITAR --}}

    <table id="tablaMetodosPago" class="table table-striped table-bordered">

    <thead>
    <tr>
        <th>Nombre del Método</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    </thead>

    <tbody></tbody>

    </table>

</body>
</html>