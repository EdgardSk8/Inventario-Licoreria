<div class="modal fade" id="modalCrearImpuesto" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Crear Impuesto</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <form id="formCrearImpuesto" class="row g-3">

          <div class="col-md-6">
            <label class="form-label">Nombre del Impuesto</label>
            <input 
              type="text"
              id="crear_nombre_impuesto"
              placeholder="Nombre del impuesto"
              class="form-control form-control-sm"
              maxlength="100"
              required
            >
          </div>

          <div class="col-md-6">
            <label class="form-label">Porcentaje (%)</label>
            <input 
              type="number"
              id="crear_porcentaje_impuesto"
              placeholder="Ejempol: 15"
              class="form-control form-control-sm"
              min="0"
              max="100"
              step="0.1"
              required
            >
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre máximo:</strong> 100 caracteres</div>
          <div><strong>Porcentaje:</strong> entre 0 y 100</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarImpuesto">Guardar</button>
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