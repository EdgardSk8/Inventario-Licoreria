<div class="modal fade" id="modalEditarEmpresa" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <!-- HEADER -->
      <div class="modal-header">
        <h5 class="modal-title">Editar Configuración de la Empresa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <form id="formEditarEmpresa" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="editar_id_empresa">

          <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text"
              id="editar_nombre_empresa"
              class="form-control form-control-sm"
              maxlength="150"
              required>
          </div>

          <div class="col-md-6">
            <label class="form-label">RUC</label>
            <input type="text"
              id="editar_ruc_empresa"
              class="form-control form-control-sm"
              maxlength="20">
          </div>

          <div class="col-md-6">
            <label class="form-label">Dirección</label>
            <input type="text"
              id="editar_direccion_empresa"
              class="form-control form-control-sm"
              maxlength="200">
          </div>

          <div class="col-md-6">
            <label class="form-label">Teléfono</label>
            <input type="text"
              id="editar_telefono_empresa"
              class="form-control form-control-sm"
              maxlength="20">
          </div>

          <div class="col-md-6">
            <label class="form-label">Correo</label>
            <input type="email"
              id="editar_correo_empresa"
              class="form-control form-control-sm"
              maxlength="100">
          </div>


        </form>

      </div>

      <!-- FOOTER -->
      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre máximo:</strong> 150 caracteres</div>
          <div><strong>Correo válido requerido</strong></div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn actualizar" id="btnActualizarEmpresa">Actualizar</button>
        </div>

        <!-- TOAST -->
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
          <div id="toastMensaje" class="toast text-bg-success border-0">
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