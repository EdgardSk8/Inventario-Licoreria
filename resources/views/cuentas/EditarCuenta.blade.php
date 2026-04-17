<div class="modal fade" id="modalEditarCuenta" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Cuenta</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <form id="formEditarCuenta" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="editar_id_cuenta">

          <div class="col-md-3">
            <label class="form-label">Nombre de la Cuenta</label>
            <input type="text"
              id="editar_nombre_cuenta"
              class="form-control form-control-sm"
              maxlength="100"
              required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Tipo de Cuenta</label>
            <input type="text"
              id="editar_tipo_cuenta"
              class="form-control form-control-sm"
              maxlength="50"
              required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Descripción</label>
            <input type="text"
              id="editar_descripcion_cuenta"
              class="form-control form-control-sm"
              maxlength="150">
          </div>

          <div class="col-md-2">
            <label class="form-label">Saldo</label>
            <input type="number"
              id="editar_saldo_cuenta"
              class="form-control form-control-sm"
              step="0.01"
              min="0"
              disabled>
          </div>

          <div class="col-md-2">
            <label class="form-label">Estado</label>
            <select id="editar_estado_cuenta"
              class="form-select form-select-sm">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
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
          <button type="button" class="btn actualizar" id="btnActualizarCuenta">Actualizar</button>
        </div>

        <!-- TOAST -->
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div id="toastMensaje" class="toast text-bg-success border-0" role="alert">
                <div class="d-flex">
                    <div id="toastTexto" class="toast-body">Mensaje</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>

      </div>

    </div>

  </div>

</div>