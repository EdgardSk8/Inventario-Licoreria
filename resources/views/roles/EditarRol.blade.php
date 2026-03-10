<div class="modal fade" id="modalEditarRol" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Rol</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <form id="formEditarRol" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="editar_id_rol">

          <div class="col-md-6">
            <label class="form-label">Nombre del Rol</label>
            <input type="text"
              id="editar_nombre_rol"
              class="form-control form-control-sm"
              maxlength="50"
              required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Descripción</label>
            <input type="text"
              id="editar_descripcion_rol"
              class="form-control form-control-sm"
              maxlength="150">
          </div>

          <div class="col-md-2">
            <label class="form-label">Estado</label>
            <select id="editar_estado_rol"
              class="form-select form-select-sm">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Fecha de Creación</label>
            <input 
              type="datetime-local"
              id="editar_fecha_creacion_rol"
              class="form-control form-control-sm" 
              disabled>
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre máximo:</strong> 50 caracteres</div>
          <div><strong>Descripción máxima:</strong> 150 caracteres</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn actualizar" id="btnActualizarRol">Actualizar</button>
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div id="toastMensaje" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div id="toastTexto" class="toast-body">Mensaje</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

      </div>

    </div>

  </div>

</div>