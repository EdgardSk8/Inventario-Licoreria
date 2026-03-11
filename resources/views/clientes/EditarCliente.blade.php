<div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Cliente</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <form id="formEditarCliente" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="editar_id_cliente">

          <div class="col-md-3">
            <label class="form-label">Nombre del Cliente</label>
            <input
              type="text"
              id="editar_nombre_cliente"
              class="form-control form-control-sm"
              maxlength="150"
              required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Cédula</label>
            <input
              type="text"
              id="editar_cedula_cliente"
              class="form-control form-control-sm"
              maxlength="16">
          </div>

          <div class="col-md-3">
            <label class="form-label">RUC</label>
            <input
              type="text"
              id="editar_ruc_cliente"
              class="form-control form-control-sm"
              maxlength="20">
          </div>

          <div class="col-md-3">
            <label class="form-label">Teléfono</label>
            <input
              type="text"
              id="editar_telefono_cliente"
              class="form-control form-control-sm"
              maxlength="20">
          </div>

          <div class="col-md-3">
            <label class="form-label">Correo</label>
            <input
              type="email"
              id="editar_correo_cliente"
              class="form-control form-control-sm"
              maxlength="100">
          </div>

          <div class="col-md-9">
            <label class="form-label">Dirección</label>
            <input
              type="text"
              id="editar_direccion_cliente"
              class="form-control form-control-sm"
              maxlength="200">
          </div>

          <div class="col-md-2">
            <label class="form-label">Estado</label>
            <select
              id="editar_estado_cliente"
              class="form-select form-select-sm">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Fecha de Creación</label>
            <input
              type="datetime-local"
              id="editar_fecha_creacion_cliente"
              class="form-control form-control-sm"
              disabled>
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre máximo:</strong> 150 caracteres</div>
          <div><strong>Cédula máxima:</strong> 16 caracteres</div>
          <div><strong>RUC máximo:</strong> 20 caracteres</div>
          <div><strong>Correo máximo:</strong> 100 caracteres</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn actualizar" id="btnActualizarCliente">Actualizar</button>
        </div>

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