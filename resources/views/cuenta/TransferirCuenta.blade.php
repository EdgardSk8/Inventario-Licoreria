<div class="modal fade" id="modalTransferir" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm">

            <!-- Header -->
            <div class="modal-header border-0 justify-content-center">
                <h5 class="modal-title fw-semibold text-center">Transferencia</h5>
            </div>

            <!-- Body -->
            <div class="modal-body px-4">

                <input type="hidden" id="id_caja">

                <!-- Info -->
                <div class="mb-4 small text-muted">

                    <div class="d-flex justify-content-between">
                        <span>Caja</span>
                        <span id="infoCaja" class="fw-semibold text-dark"></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Fecha</span>
                        <span id="infoFecha" class="fw-semibold text-dark"></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Saldo inicial</span>
                        <span id="infoInicial" class="fw-semibold text-dark"></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Saldo actual</span>
                        <span id="infoFinal" class="fw-semibold text-success"></span>
                    </div>

                </div>

                <!-- Monto -->
                <div class="mb-3">
                    <label class="form-label small text-muted">Monto</label>
                    <input type="number" step="0.01" id="monto" class="form-control form-control-sm" placeholder="0.00" required>
                </div>

                <!-- Saldo restante -->
                <div class="mb-3">
                    <label class="form-label small text-muted">Saldo restante</label>
                    <input type="text" id="saldo_restante" class="form-control form-control-sm text-center fw-semibold" disabled>
                </div>

                <!-- Cuenta -->
                <div class="mb-2">
                    <label class="form-label small text-muted">Cuenta destino</label>
                    <select id="cuenta" class="form-select form-select-sm"></select>
                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 px-4 pb-4">
                <button class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary btn-sm" id="btnGuardarTransferencia">
                    Confirmar
                </button>
            </div>

        </div>
    </div>
</div>