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
    <script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

    <div class="container">

        @include('movimiento_caja.CheckColumnasCaja')
        
        <table id="tablaMovimientosCaja" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Caja</th>
                    <th>Tipo</th>
                    <th>Concepto</th>
                    <th>Monto</th>
                    <th>Cuenta Destino</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>

</body>
</html>