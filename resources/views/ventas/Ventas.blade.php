<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Ventas</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ Vite::asset('resources/js/ventas/MostrarVentas.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

    <table id="tablaVentas" class="table table-striped table-bordered">

        <thead>
            <tr>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>Impuesto</th>
                <th>Total</th>
                <th>Método Pago</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

</body>
</html>