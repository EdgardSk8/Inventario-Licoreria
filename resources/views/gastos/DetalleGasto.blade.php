<div class="modal fade" id="modalDetalleGasto" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header bg-dark text-white d-flex justify-content-between">

                <h5 class="modal-title">
                    Detalle de Gasto: <span id="detalleNombreGasto">—</span>
                </h5>

                <div class="d-flex gap-2">

                    <button class="btn btn-success btn-sm" id="btnImprimirGasto">
                        <i class="bi bi-printer"></i> Imprimir
                    </button>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

                </div>

            </div>

            <!-- BODY -->
            <div class="modal-body" id="areaImprimirGasto">

                <!-- INFO GENERAL -->
                <div class="row mb-3">

                    <div class="col-6">
                        <strong>Tipo:</strong> <span id="detalleTipoGasto">—</span><br>
                        <strong>Descripción:</strong> <span id="detalleDescripcion">—</span>
                    </div>

                    <div class="col-6 text-end">
                        <strong>Último pago:</strong> <span id="detalleUltimoPago">—</span>
                    </div>

                </div>

                <!-- HISTORIAL -->
                <div class="table-responsive">

                    <table class="table table-sm table-bordered text-center align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Origen</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody id="tablaHistorialGasto">
                            <!-- JS -->
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>