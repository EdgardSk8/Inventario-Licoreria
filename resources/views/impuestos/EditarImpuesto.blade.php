<div class="modal fade" id="modalEditarImpuesto" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Impuesto</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <form id="formEditarImpuesto" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="editar_id_impuesto">

          <div class="col-md-6">
            <label class="form-label">Nombre del Impuesto</label>
            <input 
              type="text"
              id="editar_nombre_impuesto"
              class="form-control form-control-sm"
              maxlength="100"
              required>
          </div>

          <div class="col-md-4">
            <label class="form-label">Porcentaje (%)</label>
            <input 
              type="number"
              id="editar_porcentaje_impuesto"
              class="form-control form-control-sm"
              min="0"
              max="100"
              step="0.01"
              required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Estado</label>
            <select 
              id="editar_estado_impuesto"
              class="form-select form-select-sm">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Fecha de Creación</label>
            <input 
              type="datetime-local"
              id="editar_fecha_creacion_impuesto"
              class="form-control form-control-sm"
              disabled>
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre máximo:</strong> 100 caracteres</div>
          <div><strong>Porcentaje permitido:</strong> 0 a 100</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn actualizar" id="btnActualizarImpuesto">Actualizar</button>
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