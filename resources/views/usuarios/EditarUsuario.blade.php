<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <form id="formEditarUsuario" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="editar_id_usuario">

          <div class="col-md-4">
            <label class="form-label">Nombre Completo</label>
            <input type="text"
              id="editar_nombre_completo_usuario"
              class="form-control form-control-sm"
              pattern="^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$"
              required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Cédula</label>
            <input type="text"
              id="editar_cedula_usuario"
              class="form-control form-control-sm"
              maxlength="16"
              placeholder="000-000000-0000A"
              required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Nombre de Usuario</label>
            <input type="text"
              id="editar_nombre_usuario"
              class="form-control form-control-sm"
              required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Rol</label>
            <select id="editar_rol_usuario"
              class="form-select form-select-sm">
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Estado</label>
            <select id="editar_estado_usuario"
              class="form-select form-select-sm">

              <option value="1">Activo</option>
              <option value="0">Inactivo</option>

            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Nueva Contraseña</label>
            <input type="password"
              id="editar_password_usuario"
              minlength="6"
              placeholder="Opcional"
              class="form-control form-control-sm">
          </div>

          <div class="col-md-2">
            <label class="form-label">Fecha Creación</label>

            <input 
            type="datetime-local"
            id="editar_fecha_creacion"
            class="form-control form-control-sm" disabled>

            </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">

          <div><strong>Formato cédula:</strong> 000-000000-0000A</div>
          <div><strong>Contraseña:</strong> opcional (mínimo 6 si se cambia)</div>

        </div>

        <div>

          <button class="btn cancelar" data-bs-dismiss="modal">
            Cancelar
          </button>

          <button type="button"
            class="btn actualizar"
            id="btnActualizarUsuario">

            Actualizar

          </button>

        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div id="toastMensaje" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                <div id="toastTexto" class="toast-body">
                    Mensaje
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

      </div>

    </div>

  </div>

</div>