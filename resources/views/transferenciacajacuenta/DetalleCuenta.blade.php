<div class="modal fade" id="modalDetalleTransferencias" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header bg-dark text-white d-flex justify-content-between align-items-center">

                <h5 class="modal-title">
                    Transferencias de Caja: <span id="cajaDetalleTitulo">—</span>
                </h5>

                <div class="d-flex align-items-center gap-2">

                    <button type="button" class="btn btn-success btn-sm" id="btnImprimirTransferencias">
                        <i class="bi bi-printer"></i> Imprimir
                    </button>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

                </div>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- INFO GENERAL -->
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Caja:</strong> <span id="detalleCajaNumero">—</span><br>
                        <strong>Total transferido:</strong> <span id="detalleTotalTransferido">C$ 0.00</span>
                    </div>

                    <div class="col-6 text-end">
                        <strong>Cantidad de transferencias:</strong>
                        <span id="detalleCantidadTransferencias">0</span> <br>

                        <!-- <strong>Saldo actual de Cuenta:</strong>
                        <span id="detalleSaldoTransferencias">C$ 0.00</span> -->
                    </div>
                </div>

                <!-- TABLA -->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered text-center align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Cuenta</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>

                        <tbody id="tablaDetalleTransferencias">
                            <!-- JS -->
                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>

</div>