<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Compras</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ Vite::asset('resources/js/compras/MostrarCompras.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/compras/DetalleCompra.js') }}"></script>
    <!-- <script src="{{ Vite::asset('resources/js/compras/ImprimirFacturaCompra.js') }}"></script> -->
    

</head>

<body>

    @include('compras.CheckColumnasCompras')

    <table id="tablaCompras" class="table table-striped table-bordered">

        <thead>
            <tr>
                <th>Identificador</th>
                <th>Factura</th>
                <th>Proveedor</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Impuesto</th>
                <th>Total</th>
                <th>Método Pago</th>
                <th>Estado</th>
                <th>Detalles</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

    @include('compras.DetalleCompra')

    <!-- ╔════════ Mensaje Toast ══════════╗ -->
    <!-- ╚═════════════════════════════════╝ -->

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