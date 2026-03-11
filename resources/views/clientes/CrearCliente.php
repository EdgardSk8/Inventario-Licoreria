<div class="modal fade" id="modalCrearCliente" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Crear Cliente</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <form id="formCrearCliente" class="row g-3">

          <div class="col-md-3">
            <label class="form-label">Nombre del Cliente</label>
            <input type="text" id="crear_nombre_cliente" placeholder="Nombre del Cliente"
            class="form-control form-control-sm" maxlength="150" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Cédula</label>
            <input type="text" id="crear_cedula_cliente" placeholder="Cédula del Cliente"
            class="form-control form-control-sm" maxlength="16">
          </div>

          <div class="col-md-3">
            <label class="form-label">RUC</label>
            <input type="text" id="crear_ruc_cliente" placeholder="RUC del Cliente"
            class="form-control form-control-sm" maxlength="20">
          </div>

          <div class="col-md-3">
            <label class="form-label">Teléfono</label>
            <input type="text" id="crear_telefono_cliente" placeholder="Teléfono del Cliente"
            class="form-control form-control-sm" maxlength="20">
          </div>

          <div class="col-md-3">
            <label class="form-label">Correo</label>
            <input type="email" id="crear_correo_cliente" placeholder="Correo del Cliente"
            class="form-control form-control-sm" maxlength="100">
          </div>

          <div class="col-md-9">
            <label class="form-label">Dirección</label>
            <input type="text" id="crear_direccion_cliente" placeholder="Dirección del Cliente"
            class="form-control form-control-sm" maxlength="200">
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Cédula máxima:</strong> 16 caracteres</div>
          <div><strong>RUC máximo:</strong> 20 caracteres</div>
          <div><strong>Correo máximo:</strong> 100 caracteres</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarCliente">Guardar</button>
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