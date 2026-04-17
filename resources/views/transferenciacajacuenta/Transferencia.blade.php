<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transferencia Caja a Cuenta</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <!-- JS -->
    <script src="{{ Vite::asset('resources/js/transferencias/MostrarCajaTransferencia.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/transferencias/TransferirCajaCuenta.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/transferencias/DetalleTransferencia.js') }}"></script>


    <script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

    @include('transferenciacajacuenta.TransferirCuenta')


<div class="container">

    <table id="tablaCajaCuenta" class="table table-striped table-bordered text-center align-middle">

        <thead class="table-dark">
            <tr>
                <th title="Identificador de la caja">Caja</th>

                <th title="Fecha de cierre">Fecha</th>

                <th title="Monto con el que se abrió la caja">Abre Caja</th>

                <th title="Monto final al cerrar la caja">Cierra Caja</th>

                <th title="Saldo Actual de la caja">Saldo</th>

                <th title="Total transferido desde esta  hacia cuentas">Transferido</th>

                <th title="Cuenta bancaria o contable destino">Cuenta Transferida</th>

                <th title="Acciones disponibles (transferir, ver detalle)">Acciones</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

</div>

@include('transferenciacajacuenta.DetalleCuenta')


    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div id="toastMensaje" class="toast text-bg-success border-0">

            <div class="d-flex">

            <div class="toast-body" id="toastTexto"></div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>

            </div>

        </div>

</body>
</html>