<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kardex de Productos</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/movimiento_inventario/Movimiento_Inventario.css') }}">

    <!-- Scripts -->
    <script src="{{ Vite::asset('resources/js/inventario/movimientosInventario.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

    <div class="container">

        @include('inventario.CheckColumnas')
        
        <table id="tablaKardex" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Movimiento</th>
                    <th>Tipo</th>
                    <th>Motivo Movimiento</th>
                    <th>Cant</th>
                    <th>Stock Actual</th>
                    <th>Precio</th>
                    <th>Total Vendido C$</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</body>
</html>