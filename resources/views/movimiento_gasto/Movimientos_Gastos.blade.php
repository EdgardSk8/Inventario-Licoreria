<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Historial de Gastos</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ Vite::asset('resources/js/movimiento_gasto/MostrarMovimientosGastos.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/principal/formatofecha.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<body>

    {{-- (Opcional) si luego querés controlar columnas como en ventas --}}
 

    <table id="tablaMovimientosGastos" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>Fecha</th>
                <th>Gasto</th>
                <th>Monto</th>
                <th>Origen</th>
                <th>Caja</th>
                <th>Cuenta</th>
                <th>Usuario</th>
                <th>Observación</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

    <!--    ╔════════ Mensaje Toast ══════════╗ 
            ╚═════════════════════════════════╝     -->

    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div id="toastMensaje" class="toast text-bg-success border-0">

            <div class="d-flex">

                <div class="toast-body" id="toastTexto"></div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"></button>

            </div>

        </div>

    </div>

</body>
</html>