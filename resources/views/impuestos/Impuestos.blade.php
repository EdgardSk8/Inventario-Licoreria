<!DOCTYPE html>

<html lang="es">

<!-- ═════════════════════════ (HEAD - CONFIGURACIÓN GENERAL) ═════════════════════════ -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Impuestos</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ═══════════════════════════ ESTILOS (CSS) ═══════════════════════════ -->

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <!-- ═══════════════════════════ SCRIPTS (JS) ═══════════════════════════ -->

    <script src="{{ Vite::asset('resources/js/impuestos/MostrarImpuestos.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/impuestos/BajaImpuesto.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/impuestos/CrearImpuesto.js') }}"></script>

    <!-- ═════════════════ Sistema de notificaciones (Toast) ═════════════════ -->

    

</head>

<!-- ═════════════════════════ (BODY - INTERFAZ DE USUARIO) ═════════════════════════ -->

<body>

    @include('impuestos.CheckColumnasImpuestos')
    @include('impuestos.CrearImpuesto')
    @include('impuestos.EditarImpuesto')

<!-- ═════════════════════════════ Tabla (Datatables) ════════════════════════════ -->

    <table id="tablaImpuestos" class="table table-striped table-bordered">

        <thead>
            <tr>
                <th>Nombre del Impuesto</th>
                <th>Porcentaje (%)</th>
                <th>Fecha de Creación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

<!-- ═════════════════════════════════════════════════════════════════════════════ -->

</body>
</html>