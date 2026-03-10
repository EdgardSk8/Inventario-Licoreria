<div class="modal fade" id="modalCrearTipoGasto" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Crear Tipo de Gasto</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <form id="formCrearTipoGasto" class="row g-3">

          <div class="col-md-6">
            <label class="form-label">Nombre del Tipo de Gasto</label>
            <input type="text" 
                   id="crear_nombre_tipo_gasto"
                   placeholder="Nombre del Tipo de Gasto"
                   class="form-control form-control-sm"
                   maxlength="100"
                   required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Descripción</label>
            <input type="text"
                   id="crear_descripcion_tipo_gasto"
                   placeholder="Descripción del Tipo de Gasto"
                   class="form-control form-control-sm"
                   maxlength="150">
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre máximo:</strong> 100 caracteres</div>
          <div><strong>Descripción máxima:</strong> 150 caracteres</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarTipoGasto">Guardar</button>
        </div>

      </div>

    </div>

  </div>

</div>

<div class="toast-container position-fixed top-0 end-0 p-3">

  <div id="toastMensaje" class="toast text-bg-success border-0">

    <div class="d-flex">
      <div class="toast-body" id="toastTexto"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>

  </div>

</div>