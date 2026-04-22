<div class="modal fade" id="modalCrearCuenta" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Crear Cuenta</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <form id="formCrearCuenta" class="row g-3">

            <div class="col-md-4">
                <label class="form-label">Nombre de la Cuenta</label>
                <input type="text" 
                    id="crear_nombre_cuenta"
                    placeholder="Ej: Caja General, Banco BAC"
                    class="form-control form-control-sm"
                    maxlength="100"
                    required>
            </div>

            <div class="col-md-3">
              <label class="form-label">Tipo de Cuenta</label>
              <select id="crear_tipo_cuenta"
                  class="form-select form-select-sm"
                  required>
                  
                  <option value="CAJA">Caja</option>
                  <option value="BANCO">Banco</option>
                  <option value="AHORRO">Ahorro</option>
                  <option value="TARJETA">Tarjeta</option>
                  <option value="CREDITO">Crédito</option>
                  
              </select>
          </div>

            <div class="col-md-5">
                <label class="form-label">Descripción</label>
                <input type="text"
                    id="crear_descripcion_cuenta"
                    placeholder="Descripción opcional"
                    class="form-control form-control-sm"
                    maxlength="150">
            </div>

            <div class="col-md-3">
                <label class="form-label">Saldo Inicial</label>
                <input type="number"
                    id="crear_saldo_cuenta"
                    class="form-control form-control-sm"
                    placeholder="0.00"
                    step="0.01"
                    min="0"
                    required>
            </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre máximo:</strong> 100 caracteres</div>
          <div><strong>Saldo:</strong> Solo valores positivos</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarCuenta">Guardar</button>
        </div>

      </div>

    </div>

  </div>

</div>


<!-- TOAST -->
<div class="toast-container position-fixed top-0 end-0 p-3">

  <div id="toastMensaje" class="toast text-bg-success border-0">

    <div class="d-flex">
      <div class="toast-body" id="toastTexto"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>

  </div>

</div>