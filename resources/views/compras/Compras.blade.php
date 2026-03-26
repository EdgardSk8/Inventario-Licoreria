<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>

    <script src="{{ Vite::asset('resources/js/compras/Compras.js') }}"></script>

</head>

<body>

    <div class="container-fluid">

        <!-- 🔹 HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Registrar Compra</h6>
        </div>

        <!-- 🔹 DATOS PRINCIPALES -->
        <div class="card mb-2">
            <div class="card-body" style="padding: 5px 10px 10px 10px;">
                <div class="row g-2"> <!-- g-3 agrega espacio entre columnas -->

                <div class="col-md-4">
                    <label class="form-label small">Proveedor</label>
                    <select class="form-select form-select-sm" id="proveedor">
                    <option value="" selected disabled>Seleccione un proveedor</option>
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
            </div>

        <!-- 🔍 PRODUCTOS -->

        <div class="card mb-2">
            <div class="card-body" style="padding: 0px 10px 10px 10px;">
                <div class="row g-1 align-items-end">

                    <!-- Selector de producto -->
                    <div class="col-md-7">
                        <label class="small">Producto</label>
                        <select id="producto_select" class="form-select form-select-sm"></select>
                    </div>

                    <!-- Cantidad -->
                    <div class="col-md-1">
                        <label class="small">Cantidad</label>
                        <input type="number" id="cantidad" class="form-control form-control-sm" value="1" min="1">
                    </div>

                    <!-- Botón Agregar -->
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-sm w-100" id="btnAgregar">
                            Agregar
                        </button>
                    </div>

                    <!-- Botón Nuevo Producto -->
                    <div class="col-md-2">
                        <button class="btn btn-success btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modalProducto">
                            Nuevo Producto
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- 📦 CARRITO -->
        <div class="card mb-2">
            <div class="card-body py-2">

                <table id="tabla_carrito" class="table table-sm table-bordered w-100 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cant</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Desc</th>
                            <th>Imp</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div>

        <!-- 💰 TOTALES -->
        <div class="card mb-2">
            <div class="card-body py-2">

                <div class="row g-1 justify-content-end">

                    <div class="col-md-2">
                        <label class="small">Subtotal</label>
                        <input type="text" id="subtotal" class="form-control form-control-sm text-end" readonly>
                    </div>

                    <div class="col-md-2">
                        <label class="small">Descuento</label>
                        <input type="number" id="descuento" class="form-control form-control-sm text-end" value="0">
                    </div>

                    <div class="col-md-2">
                        <label class="small">Impuesto</label>
                        <input type="number" id="impuesto" class="form-control form-control-sm text-end" value="0">
                    </div>

                    <div class="col-md-2">
                        <label class="small fw-bold">Total</label>
                        <input type="text" id="total" class="form-control form-control-sm text-end fw-bold" readonly>
                    </div>

                </div>

            </div>
        </div>

        <!-- 🔹 ACCIONES -->
        <div class="d-flex justify-content-end gap-2">

            <button class="btn btn-secondary btn-sm" id="btnLimpiar">
                Limpiar
            </button>

            <button class="btn btn-success btn-sm" id="btnRegistrar">
                Registrar Compra
            </button>

        </div>

    </div>







    
</body>

</html>