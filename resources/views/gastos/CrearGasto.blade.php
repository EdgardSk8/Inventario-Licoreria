<div class="modal fade" id="modalCrearGasto" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Crear Gasto</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form id="formCrearGasto" class="row g-3">

          <!-- NOMBRE -->
          <div class="col-md-6">
            <label class="form-label">Nombre del Gasto</label>
            <input type="text"
                   id="crear_nombre_gasto"
                   class="form-control form-control-sm"
                   placeholder="Ej: Pago de luz"
                   maxlength="150"
                   required>
          </div>

          <!-- TIPO -->
          <div class="col-md-6">
            <label class="form-label">Tipo de Gasto</label>
            <select id="crear_id_tipo_gasto"
                    class="form-select form-select-sm"
                    required>
            </select>
          </div>

          <!-- DESCRIPCIÓN -->
          <div class="col-md-12">
            <label class="form-label">Descripción</label>
            <textarea id="crear_descripcion_gasto"
                      class="form-control form-control-sm"
                      rows="1"
                      placeholder="Detalle opcional"></textarea>
          </div>

          <!-- FECHA PAGO -->
          <div class="col-md-6">
            <label class="form-label">Fecha de pago</label>
            <input type="date"
                   id="crear_fecha_pago"
                   class="form-control form-control-sm">
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex justify-content-between">

        <small class="text-muted">
          Define la fecha base o el próximo pago.
        </small>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarGasto">Guardar</button>
        </div>

      </div>

    </div>

  </div>

</div>