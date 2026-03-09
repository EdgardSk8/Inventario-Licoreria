<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Crear Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <form id="formCrearUsuario" class="row g-3">

          <div class="col-md-4">
            <label class="form-label">Nombre Completo</label>
            <input type="text" id="crear_nombre_completo_usuario" placeholder="Nombre Completo Real" class="form-control form-control-sm" pattern="^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$" required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Cédula</label>
            <input type="text" id="crear_cedula_usuario" class="form-control form-control-sm" maxlength="16" placeholder="000-000000-0000A" required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Nombre de Usuario</label>
            <input type="text" id="crear_nombre_usuario" placeholder="Usuario Login" class="form-control form-control-sm" required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Rol</label>
            <select id="crear_rol_usuario" class="form-select form-select-sm"></select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Contraseña</label>
            <input type="password" id="crear_password_usuario" minlength="6" placeholder="Mínimo 6 caracteres" class="form-control form-control-sm" required>
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">

          <div><strong>Formato cédula:</strong> 000-000000-0000A</div>
          <div><strong>Contraseña mínima:</strong> 6 caracteres</div>

        </div>

        <div>

          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarUsuario">Guardar</button>

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


