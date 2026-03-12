<div class="modal fade" id="modalCrearProveedor" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Crear Proveedor</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <form id="formCrearProveedor" class="row g-3">

          <div class="col-md-3">
            <label class="form-label">Nombre del Proveedor</label>
            <input type="text" id="crear_nombre_proveedor" placeholder="Nombre del proveedor"
            class="form-control form-control-sm" maxlength="150" required>
          </div>

          <div class="col-md-2">
            <label class="form-label">RUC</label>
            <input type="text" id="crear_ruc_proveedor" placeholder="RUC del proveedor"
            class="form-control form-control-sm" maxlength="15">
          </div>

          <div class="col-md-2">
            <label class="form-label">Teléfono</label>
            <input type="text" id="crear_telefono_proveedor" placeholder="Teléfono"
            class="form-control form-control-sm" maxlength="20">
          </div>

          <div class="col-md-3">
            <label class="form-label">Correo</label>
            <input type="email" id="crear_correo_proveedor" placeholder="Correo electrónico"
            class="form-control form-control-sm" maxlength="100">
          </div>

          <div class="col-md-12">
            <label class="form-label">Dirección</label>
            <input type="text" id="crear_direccion_proveedor" placeholder="Dirección del proveedor"
            class="form-control form-control-sm" maxlength="200">
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre máximo:</strong> 150 caracteres</div>
          <div><strong>RUC máximo:</strong> 15 caracteres</div>
          <div><strong>Teléfono máximo:</strong> 20 caracteres</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarProveedor">Guardar</button>
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