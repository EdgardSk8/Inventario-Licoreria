<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Movimientos de Caja</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Vite::asset('resources/css/movimiento_inventario/Movimiento_Inventario.css') }}">

    <!-- Scripts -->
    <script src="{{ Vite::asset('resources/js/movimiento_caja/Movimientos_Caja.js') }}"></script>
    

</head>

<body>

    @include("movimientos_caja.CheckColumnasMovimiento_Caja")

    <table id="tablaMovimientosCaja" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Caja</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Concepto</th>
                <th>Cuenta Destino</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

</body>
</html>