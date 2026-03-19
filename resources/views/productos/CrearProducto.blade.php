<div class="modal fade" id="modalCrearProducto" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Crear Producto</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <form id="formCrearProducto" class="row g-3">

          <!-- Nombre -->
          <div class="col-md-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" id="crear_nombre_producto" class="form-control form-control-sm" maxlength="100" required>
          </div>

           <!-- Descripción -->
          <div class="col-md-3">
            <label class="form-label">Descripción</label>
            <input type="text" id="crear_descripcion_producto" class="form-control form-control-sm" maxlength="150">
          </div>

          <!-- Categoría -->
          <div class="col-md-2">
            <label class="form-label">Categoría</label>
            <select id="crear_id_categoria" class="form-select form-select-sm" required>
            </select>
          </div>

          <!-- Ubicación -->
          <div class="col-md-2">
            <label class="form-label">Ubicación</label>
            <select id="crear_id_ubicacion" class="form-select form-select-sm" required>
            </select>
          </div>

          <!-- Impuesto -->
          <div class="col-md-2">
            <label class="form-label">Impuesto</label>
            <select id="crear_id_impuesto" class="form-select form-select-sm" required>
            </select>
          </div>

          <!-- Precio compra -->
          <div class="col-md-2">
            <label class="form-label">Precio Compra</label>
            <input type="number" id="crear_precio_compra" class="form-control form-control-sm" min="0" step="1.00" required>
          </div>

          <!-- Precio venta -->
          <div class="col-md-2">
            <label class="form-label">Precio Venta</label>
            <input type="number" id="crear_precio_venta" class="form-control form-control-sm" min="0" step="1.00" required>
          </div>

          <!-- Stock -->
          <div class="col-md-2">
            <label class="form-label">Stock Inicial</label>
            <input type="number" id="crear_stock_actual" class="form-control form-control-sm" min="0" required>
          </div>

          <!-- Imagen -->
          <div class="col-md-3">
            <label class="form-label">Imagen del Producto</label>
            <input type="file" id="crear_imagen_producto" class="form-control form-control-sm" accept="image/*">
          </div>

          <div class="mt-2 text-center">
            <img id="preview_imagen_producto" 
                src="" 
                alt="Vista previa" 
                class="img-thumbnail d-none" 
                style="max-height: 120px;">
          </div>

        </form>

      </div>

      <div class="modal-footer d-flex align-items-center justify-content-between">

        <div class="text-start">
          <div><strong>Nombre:</strong> máx. 100 caracteres</div>
          <div><strong>Descripción:</strong> máx. 150 caracteres</div>
        </div>

        <div>
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarProducto">Guardar</button>
        </div>

      </div>

    </div>

  </div>

</div>

<!-- TOAST (igual reutilizable) -->
<div class="toast-container position-fixed top-0 end-0 p-3">

  <div id="toastMensaje" class="toast text-bg-success border-0">

    <div class="d-flex">
      <div class="toast-body" id="toastTexto"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>

  </div>

</div>