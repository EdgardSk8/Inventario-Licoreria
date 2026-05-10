<!DOCTYPE html>

<html lang="es">

<!-- ═════════════════════════ (HEAD - CONFIGURACIÓN GENERAL) ═════════════════════════ -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Cuentas</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ═══════════════════════════ ESTILOS (CSS) ═══════════════════════════ -->

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <!-- ═══════════════════════════ SCRIPTS (JS) ═══════════════════════════ -->

    <script src="{{ Vite::asset('resources/js/cuentas/MostrarCuentas.js') }}"></script> 
    <script src="{{ Vite::asset('resources/js/cuentas/BajaCuentas.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/cuentas/CrearCuentas.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/cuentas/TransferirCuentas.js') }}"></script>

    <!-- Sistema de notificaciones (Toast) -->
    

</head>

<!-- ═════════════════════════ (BODY - INTERFAZ DE USUARIO) ═════════════════════════ -->

<body>

    <!-- ════════════ MODALES ════════════ -->
     
    @include('cuentas.CheckColumnasCuentas')
    @include('cuentas.CrearCuenta')
    @include('cuentas.EditarCuenta')
    @include('cuentas.TransferirCuenta')

    <!-- ════════════ TABLA DE CUENTAS ════════════ -->

    <table id="tablaCuentas" class="table table-striped table-bordered">

        <thead>
            <tr>
                <th>Nombre Cuenta</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Saldo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

</body>
</html>