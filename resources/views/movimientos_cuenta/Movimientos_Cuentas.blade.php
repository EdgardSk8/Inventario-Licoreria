<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Movimientos de Cuenta</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ Vite::asset('resources/js/movimiento_cuenta/Movimientos_Cuentas.js') }}"></script>

</head>

<body>

@include('movimientos_cuenta.CheckColumnasMovimientoCuentas')

    <table id="tablaMovimientosCuenta" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Identificador</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Cuenta</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

</body>
</html>