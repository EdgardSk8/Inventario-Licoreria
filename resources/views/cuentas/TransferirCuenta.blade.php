<!-- ╔═══════════ Modal Transferir Entre Cuentas ═══════════╗ -->
<div class="modal fade" id="ModalTransferirCuenta" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- 🔥 más ancho -->
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header bg-dark text-white py-2">
                <h6 class="modal-title">Transferir entre cuentas</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body py-2">

                <div class="row g-2">

                    <!-- ═════════════ COLUMNA IZQUIERDA (ORIGEN) ═════════════ -->
                    <div class="col-md-6 border-end">

                        <h6 class="text-primary mb-0">Cuenta origen</h6>

                        <div class="mb-2">
                            <label class="form-label small mb-0">Seleccionar cuenta</label>
                            <select class="form-select form-select-sm" id="cuenta_origen">
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small mb-0">Saldo actual de la cuenta origen</label>
                            <input type="text" class="form-control form-control-sm" id="saldo_origen" disabled>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small mb-0">Saldo resultante</label>
                            <input type="text"
                                class="form-control form-control-sm fw-bold text-danger"
                                id="saldo_origen_resultante" disabled>
                        </div>

                    </div>

                    <!-- ═════════════ COLUMNA DERECHA (DESTINO) ═════════════ -->
                    <div class="col-md-6">

                        <h6 class="text-success mb-0">Cuenta destino</h6>

                        <div class="mb-2">
                            <label class="form-label small mb-0">Seleccionar cuenta</label>
                            <select class="form-select form-select-sm" id="cuenta_destino">
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small mb-0">Saldo actual de la cuenta origen destino</label>
                            <input type="text" class="form-control form-control-sm" id="saldo_destino" disabled>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small mb-0">Saldo resultante</label>
                            <input type="text"
                                class="form-control form-control-sm fw-bold text-success"
                                id="saldo_destino_resultante" disabled>
                        </div>

                    </div>

                </div>

                <!-- ═════════════ MONTO (CENTRADO) ═════════════ -->
                <div class="row mt-2">
                    <div class="col-md-6 mx-auto">
                        <label class="form-label small mb-0">Monto a transferir</label>
                        <input type="number" min="0" step="0.01"
                            class="form-control form-control-sm text-center fw-bold"
                            id="monto_transferencia">
                    </div>
                </div>

                <!-- ═════════════ CONCEPTO ═════════════ -->
                <hr class="my-2">

                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="usar_input_concepto">
                    <label class="form-check-label small">
                        Escribir concepto manual
                    </label>
                </div>

                <!-- SELECT -->
                <div class="mb-2" id="grupo_selector_concepto">
                    <label class="form-label small mb-0">Concepto</label>
                    <select class="form-select form-select-sm" id="selector_concepto">
                        <option value="Reorganización de fondos entre cuentas">Reorganización de fondos entre cuentas</option>
                            <option value="Cobertura de gastos operativos">Cobertura de gastos operativos</option>
                            <option value="Pago interno desde otra cuenta">Pago interno desde otra cuenta</option>
                            <option value="Ajuste de saldos entre cuentas">Ajuste de saldos entre cuentas</option>
                            <option value="Movimiento por control financiero">Movimiento por control financiero</option>
                    </select>
                </div>

                <!-- INPUT -->
                <div class="mb-2 d-none" id="grupo_input_concepto">
                    <label class="form-label small mb-0">Concepto manual</label>
                    <input type="text" class="form-control form-control-sm" id="input_concepto">
                </div>

            </div>


            <!-- FOOTER -->
            <div class="modal-footer py-2">

                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>

                <button type="button" class="btn btn-sm btn-success" id="btnTransferir">
                    Transferir
                </button>

            </div>

        </div>
    </div>
</div>