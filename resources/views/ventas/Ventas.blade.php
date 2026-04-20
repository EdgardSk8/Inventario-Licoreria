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
    <script src="{{ Vite::asset('resources/js/ventas/DetalleVenta.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/ventas/ImprimirFacturaVenta.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

    @include('ventas.CheckColumnasVentas')

    <table id="tablaVentas" class="table table-striped nowrap">

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
                <th>Detalles</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

    @include('ventas.DetalleVenta')

<!--    ╔════════ Mensaje Toast ══════════╗ 
        ╚═════════════════════════════════╝     -->

    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div id="toastMensaje" class="toast text-bg-success border-0">

            <div class="d-flex">

            <div class="toast-body" id="toastTexto"></div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>

            </div>

        </div>

    </div>

</body>
</html>