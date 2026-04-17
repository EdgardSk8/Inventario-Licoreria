<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Cajas</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <script src="{{ Vite::asset('resources/js/cajas/MostrarCajas.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>

    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

    <table id="tablaCajas" class="table table-striped table-bordered">

        <thead>
            <tr>
                <th>Nº Caja</th>
                <th>Usuario</th>
                <th>Fecha Apertura</th>
                <th>Fecha Cierre</th>
                <th>Monto Inicial</th>
                <th>Monto Final</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

</body>
</html>
