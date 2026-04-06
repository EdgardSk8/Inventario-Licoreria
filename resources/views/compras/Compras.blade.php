<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/compras/Compras.css') }}">
    <script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/compras/Compras.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/compras/CrearProducto.js') }}"></script>

</head>

<body>

    @include('compras.CrearProducto')

    <!-- ═════════════ ( CONTENEDOR PRINCIPAL ) ═══════════════ -->

    <div class="container-fluid">

        <!-- HEADER -->
        <div class="mb-2"> <h6 class="mb-0">Registrar Compra</h6> </div>

<!-- ---------------------------------------------------------------------------------------------------------------------- -->

        <!-- ═════════════ ( DATOS PRINCIPALES ) ═══════════════ -->

        <div class="card mb-2">

            <div class="card-body">

                <div class="row g-2">

                    <div class="col-md-4">

                        <label class="form-label small">Proveedor</label>

                        <select class="form-select form-select-sm" id="proveedor" required>
                            <option value="" selected disabled >Seleccione un proveedor</option>
                        </select>

                    </div>

                    <div class="col-md-2">

                        <label class="form-label small">N° Factura</label>
                        <input type="text" class="form-control form-control-sm" id="numero_factura">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label small">Tipo Factura</label>

                        <select class="form-select form-select-sm" id="tipo_factura">
                            <option value="" selected disabled>Seleccione un Tipo de Factura</option>
                        </select>

                    </div>

                    <div class="col-md-3">
                        <label class="form-label small">Método Pago</label>
                        <select class="form-select form-select-sm" id="metodo_pago"></select>
                    </div>

                    <div class="col-md-3">

                        <label class="form-label small">Tipo de Pago</label>

                        <select class="form-select form-select-sm" id="cajacuentaselect">
                            <option value="" selected disabled>Seleccione un Tipo de Pago</option>
                            <option value="caja">Caja</option>
                            <option value="cuenta">Cuenta</option>
                        </select>

                    </div>

                    <div class="col-md-5">

                        <label class="form-label small">Caja</label>
                        <select class="form-select form-select-sm" disabled id="caja_select"></select>

                    </div>

                    <div class="col-md-4">

                        <label class="form-label small">Cuenta</label>
                        <select class="form-select form-select-sm" disabled id="cuenta"></select>

                    </div>

                </div>

            </div>

        </div> <!-- Fin de contenedor de datos principales -->

<!-- ---------------------------------------------------------------------------------------------------------------------- -->

        <!-- ═════════════ ( PRODUCTOS ) ═══════════════ -->

        <div class="card mb-2">

            <div class="card-body py-2">

                <div class="row g-1 align-items-end">

                    <div class="col-md-7"> <!-- Selector de producto -->

                        <label class="small">Producto</label>

                        <select id="producto_select" class="form-select form-select-sm">
                            <option value="" selected disabled>Seleccione un Producto</option>
                        </select>

                    </div>

                    <div class="col-md-1"> <!-- Cantidad -->

                        <label class="small">Cantidad</label>
                        <input type="number" id="cantidad" class="form-control form-control-sm" value="" placeholder="0" min="1">

                    </div>

                    <div class="col-md-2"><!-- Botón Agregar -->

                        <button class="btn btn-primary btn-sm w-100" id="btnAgregar">
                            Agregar
                        </button>

                    </div>

                    <div class="col-md-2"> <!-- Botón Nuevo Producto -->

                        <button class="btn btn-success btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modalCrearProducto">
                            Nuevo Producto
                        </button>

                    </div>

                </div>

            </div>

        </div> <!-- Fin de contnedor de productos -->

<!-- ---------------------------------------------------------------------------------------------------------------------- -->

    <!-- ═════════════ ( CONTENEDOR CARRITO Y TOTALES ) ═══════════════ -->

    <div class="row g-2 align-items-stretch">
    
        <!-- ═════════════ ( CARRITO ) ═══════════════ -->
        
        <div class="col-md carrito-container d-flex">

            <div class="card w-100 h-100">

                <div class="card-body">

                    <table id="tabla_carrito" class="table table-sm table-bordered w-100 text-center">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>
                                <th>Producto</th>
                                <th>Cant</th>
                                <th>P. Compra</th>
                                <th>Total</th>
                                <th>Acción</th>

                            </tr>

                        </thead>

                        <tbody> <!-- ( CONTENIDO DINAMICO ) --></tbody>

                    </table> 

                </div>

            </div>

        </div> <!-- Fin Contenedor Carrito -->

        <!-- ═════════════ ( TOTALES ) ═══════════════ -->

        <div class="col-md-3 d-flex flex-column">

            <div class="card flex-grow-1">

                <div class="card-body mb-2">

                    <div class="row g-1">

                        <div class="col-12 mb-1">

                            <label class="small">Subtotal</label>
                            <input type="text" id="subtotal" class="form-control form-control-sm text-end" readonly>

                        </div>

                        <div class="col-12 mb-1">

                            <label class="small">Descuento</label>
                            <input type="number" id="descuento" class="form-control form-control-sm text-end" placeholder="0" value="">

                        </div>

                        <div class="col-12 mb-1">

                            <label class="small">Impuesto</label>
                            <input type="number" id="impuesto" class="form-control form-control-sm text-end" placeholder="0" value="">

                        </div>

                        <div class="col-12 mb-2">

                            <label class="small fw-bold">Total</label>
                            <input type="text" id="total" class="form-control form-control-sm text-end fw-bold" readonly>

                        </div>

                        <!-- ══ ( BOTONES ) ══ -->

                        <div class="col-12 mt-auto d-flex justify-content-end gap-2">

                            <button class="btn btn-secondary btn-sm" id="btnLimpiar">Limpiar</button>
                            <button class="btn btn-success btn-sm" id="btnRegistrar">Registrar Compra</button>

                        </div>

                    </div>

                </div>

            </div>

        </div> <!-- Fin Contenedor Totales -->

    </div> <!-- Fin Contenedor Carrito y Totales -->

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