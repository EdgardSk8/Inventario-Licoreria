<!DOCTYPE html>

<html lang="es">

<!-- ═════════════════════════ (HEAD - CONFIGURACIÓN GENERAL) ═════════════════════════ -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Gastos</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ═══════════════════════════ ESTILOS (CSS) ═══════════════════════════ -->

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <!-- ═══════════════════════════ SCRIPTS (JS) ═══════════════════════════ -->

    <!-- <script src="{{ Vite::asset('resources/js/impuestos/MostrarImpuestos.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/impuestos/BajaImpuesto.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/impuestos/CrearImpuesto.js') }}"></script> -->

    <!-- ═════════════════ Sistema de notificaciones (Toast) ═════════════════ -->

    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

</head>

<!-- ═════════════════════════ (BODY - INTERFAZ DE USUARIO) ═════════════════════════ -->

<body>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <!-- Botón Agregar Gasto -->

        <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalCrearGasto">
            + Agregar Gasto
        </button>

        <!-- Checkbox para ocultar inactivos -->

        <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" id="toggleInactivosImpuestos" checked>
            <label class="form-check-label" for="toggleInactivosImpuestos">Ocultar inactivos</label>
        </div>

    </div>

{{-- ══════════════════════════════════ MODALES ══════════════════════════════════ --}}

<!-- @include('impuestos.CrearImpuesto') -->
<!-- @include('impuestos.EditarImpuesto') -->

<!-- ═════════════════════════════ Tabla (Datatables) ════════════════════════════ -->

<table id="tablaGastos" class="table table-striped table-bordered">

    <thead>
        <tr>
            <th>Nombre del Gasto</th> <!-- id del tipo de gasto -->
            <th>Descripcion</th>
            <th>Monto</th>
            <th>Fecha</th>
            <th>Pago</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody></tbody>

</table>

<!-- ═════════════════════════════════════════════════════════════════════════════ -->

</body>
</html>