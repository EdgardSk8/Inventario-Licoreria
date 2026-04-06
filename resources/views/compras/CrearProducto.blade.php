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
            <input type="number" id="crear_precio_compra" class="form-control form-control-sm" step="0.01" required>
          </div>

          <!-- CHECKS -->
          <div class="col-md-1 d-flex align-items-center justify-content-between">
            <small class="mb-0">V/ R</small>
            <input type="checkbox" id="crear_check_venta" title="% de ganancia de venta">
            <input type="checkbox" id="crear_redondeo_venta" title="Redondeo total al impuesto">
          </div>

          <!-- % venta -->
          <div class="col-md-1">
            <label class="form-label">% Venta</label>
            <input type="number" id="crear_porcentaje_venta" class="form-control form-control-sm" step="0.1">
          </div>

          <!-- Precio venta -->
          <div class="col-md-1">
            <label class="form-label">P. Venta</label>
            <input type="number" id="crear_precio_venta" class="form-control form-control-sm" step="0.01" required>
          </div>

          <!-- Precio total -->
          <div class="col-md-2">
            <label class="form-label">Precio Total (+IVA)</label>
            <input type="number" id="crear_precio_venta_TOTAL" class="form-control form-control-sm">
          </div>

          <!-- Stock -->
          <div class="col-md-2">
            <label class="form-label">Cant. inicial</label>
            <input type="number" id="crear_stock_actual" class="form-control form-control-sm" min="0" required>
          </div>

          <!-- Imagen -->
          <div class="col-md-3">
            <label class="form-label">Imagen del Producto</label>
            <input type="file" id="crear_imagen_producto" class="form-control form-control-sm" accept="image/*">
          </div>

          <!-- Preview -->
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

          <div class="row flex-nowrap">

            <!-- Columna izquierda -->
            <div class="col-md-8">
              <div><strong>Nombre:</strong> máx. 100 caracteres</div>
              <div><strong>Descripción:</strong> máx. 150 caracteres</div>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-6">
              <div><strong>V:</strong> Porcentaje de venta</div>
              <div><strong>R:</strong> Redondeo de venta</div>
            </div>

          </div>

        </div>

        <div >
          <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn guardar" id="btnGuardarProducto">Guardar</button>
        </div>

      </div>



    </div>

  </div>

</div>