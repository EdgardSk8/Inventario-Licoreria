<div class="modal fade" id="modalCrearRol" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Crear Rol</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <form id="formCrearRol" class="row g-3">

          <div class="col-md-6">
            <label class="form-label">Nombre del Rol</label>
            <input type="text" id="crear_nombre_rol" placeholder="Nombre del Rol" class="form-control form-control-sm" maxlength="50" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Descripción</label>
            <input type="text" id="crear_descripcion_rol" placeholder="Descripción del Rol" class="form-control form-control-sm" maxlength="150">
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
          <button type="button" class="btn guardar" id="btnGuardarRol">Guardar</button>
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