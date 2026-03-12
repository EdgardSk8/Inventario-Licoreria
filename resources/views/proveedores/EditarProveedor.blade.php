<div class="modal fade" id="modalEditarProveedor" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Proveedor</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <form id="formEditarProveedor" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="editar_id_proveedor">

          <div class="col-md-4">
            <label class="form-label">Nombre del Proveedor</label>
            <input type="text"
              id="editar_nombre_proveedor"
              class="form-control form-control-sm"
              maxlength="150"
              required>
          </div>

          <div class="col-md-2">
            <label class="form-label">RUC</label>
            <input type="text"
              id="editar_ruc_proveedor"
              class="form-control form-control-sm"
              maxlength="15">
          </div>

          <div class="col-md-2">
            <label class="form-label">Teléfono</label>
            <input type="text"
              id="editar_telefono_proveedor"
              class="form-control form-control-sm"
              maxlength="8">
          </div>

          <div class="col-md-4">
            <label class="form-label">Correo</label>
            <input type="email"
              id="editar_correo_proveedor"
              class="form-control form-control-sm"
              maxlength="100">
          </div>

          <div class="col-md-12">
            <label class="form-label">Dirección</label>
            <input type="text"
              id="editar_direccion_proveedor"
              class="form-control form-control-sm"
              maxlength="200">
          </div>

          <div class="col-md-2">
            <label class="form-label">Estado</label>
            <select id="editar_estado_proveedor"
              class="form-select form-select-sm">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Fecha de Creación</label>
            <input
              type="datetime-local"
              id="editar_fecha_creacion_proveedor"
              class="form-control form-control-sm"
              disabled>
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>RUC máximo:</strong> 14 caracteres</div>
          <div><strong>Teléfono máximo:</strong> 8 caracteres</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn actualizar" id="btnActualizarProveedor">Actualizar</button>
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div id="toastMensaje" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
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