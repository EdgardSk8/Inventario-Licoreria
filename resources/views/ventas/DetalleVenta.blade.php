<div class="modal fade" id="modalDetalleVenta" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header bg-dark text-white d-flex justify-content-between align-items-center">

                <h5 class="modal-title" id="facturaTitulo">
                    Factura: —
                </h5>

                <div class="d-flex align-items-center gap-2">

                    <button type="button" class="btn btn-success btn-sm" id="btnImprimir">
                        🖨 Imprimir Factura de Venta
                    </button>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

                </div>

            </div>

            <!-- BODY -->
            <div class="modal-body" id="areaImprimir">

                <!-- INFO GENERAL -->
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Cliente:</strong> <span id="clienteNombre">—</span> <br>
                        <strong>Usuario:</strong> <span id="usuarioNombre">—</span>
                    </div>

                    <div class="col-6 text-end">
                        <strong>Fecha:</strong> <span id="fechaVenta">—</span> <br>
                        <strong>Método Pago:</strong> <span id="metodoPago">—</span>
                    </div>
                </div>

                <!-- TABLA DE PRODUCTOS -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Cant</th>
                                <th>Precio</th>
                                <th>Impuesto</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDetalles">
                            <!-- JS inserta aquí -->
                        </tbody>
                    </table>
                </div>

                <!-- TOTALES -->
                <div class="row mt-3">
                    <div class="col-6"></div>

                    <div class="col-6">
                        <div class="d-flex justify-content-between">
                            <strong>Subtotal:</strong>
                            <span id="subtotalVenta">C$ 0.00</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <strong>Impuesto:</strong>
                            <span id="impuestoVenta">C$ 0.00</span>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-2">
                            <strong>Total:</strong>
                            <strong id="totalVenta">C$ 0.00</strong>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>