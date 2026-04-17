<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Movimientos de Cuenta</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/movimiento_cuenta/Movimiento_Cuenta.css') }}">

    <!-- Scripts -->
    <script src="{{ Vite::asset('resources/js/movimiento_cuenta/Movimientos_Cuentas.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

    <div>

        {{-- (Opcional) Check para mostrar/ocultar columnas --}}
        @include('movimiento_cuenta.CheckColumnasCuenta')

        <table id="tablaMovimientosCuenta" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Cuenta</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Transferencia</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>

</body>
</html>