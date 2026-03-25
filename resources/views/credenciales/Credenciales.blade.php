<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ Vite::asset('resources/js/credenciales/Credenciales.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/credenciales/EditarCredenciales.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>
    
</head>
<body>
    <div class="container-fluid">

    <!-- ╔════════════ CARD ════════════╗ -->
    <!-- ╚══════════════════════════════╝ -->

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">
                <i class="bi bi-building"></i> Configuración de la Empresa
            </h6>

            <button class="btn btn-primary btn-sm" id="btnEditar">
                <i class="bi bi-pencil"></i> Editar
            </button>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-2">
                    <strong>Nombre:</strong>
                    <div id="nombre_empresa">-</div>
                </div>

                <div class="col-md-6 mb-2">
                    <strong>RUC:</strong>
                    <div id="ruc_empresa">-</div>
                </div>

                <div class="col-md-6 mb-2">
                    <strong>Dirección:</strong>
                    <div id="direccion_empresa">-</div>
                </div>

                <div class="col-md-6 mb-2">
                    <strong>Teléfono:</strong>
                    <div id="telefono_empresa">-</div>
                </div>

                <div class="col-md-6 mb-2">
                    <strong>Correo:</strong>
                    <div id="correo_empresa">-</div>
                </div>

            </div>

        </div>

    </div>

</div>
@include('credenciales.EditarCredenciales')
</body>
</html>