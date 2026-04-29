<div class="modal fade" id="modalEditarGasto" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Gasto</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <form id="formEditarGasto" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="editar_id_gasto">

          <div class="col-md-6">
            <label class="form-label">Nombre del Gasto</label>
            <input type="text"
              id="editar_nombre_gasto"
              class="form-control form-control-sm"
              maxlength="150"
              required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Tipo de Gasto</label>
            <select id="editar_id_tipo_gasto"
              class="form-select form-select-sm"
              required>
            </select>
          </div>

          <div class="col-md-8">
            <label class="form-label">Descripción</label>
            <textarea id="editar_descripcion_gasto"
              class="form-control form-control-sm"
              rows="1"
              placeholder="Detalle del gasto"></textarea>
          </div>

          <div class="col-md-4">
            <label class="form-label">Estado</label>
            <select id="editar_estado_gasto"
              class="form-select form-select-sm">

              <option value="1">Activo</option>
              <option value="0">Inactivo</option>

            </select>
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex justify-content-between">

        <div class="text-start">
          <small><strong>Nota:</strong> Solo se edita la información del gasto, no sus pagos.</small>
        </div>

        <div>

          <button class="btn cancelar" data-bs-dismiss="modal">
            Cancelar
          </button>

          <button type="button"
            class="btn actualizar"
            id="btnActualizarGasto">

            Actualizar

          </button>

        </div>

      </div>

    </div>

  </div>

</div>