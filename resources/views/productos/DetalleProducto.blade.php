<div class="modal fade" id="modalDetalleProducto" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Cabecera -->
      <div class="modal-header">
        <h6 class="modal-title">Detalle del Producto</h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Cuerpo -->
      <div class="modal-body">

        <ul class="list-group list-group-flush small">

          <li class="list-group-item">
            <strong>Nombre:</strong>
            <span id="detalle_nombre_producto"></span>
          </li>

          <li class="list-group-item">
            <strong>Descripción:</strong>
            <span id="detalle_descripcion_producto"></span>
          </li>

          <li class="list-group-item">
            <strong>Categoría:</strong>
            <span id="detalle_categoria_producto"></span>
          </li>

          <li class="list-group-item">
            <strong>Ubicación:</strong>
            <span id="detalle_ubicacion_producto"></span>
          </li>

          <li class="list-group-item">
            <strong>Impuesto:</strong>
            <span id="detalle_impuesto_producto"></span>
          </li>

          <li class="list-group-item">
            <strong>Precio Compra:</strong>
            <span id="detalle_precio_compra"></span>
          </li>

          <li class="list-group-item">
            <strong>Precio Venta:</strong>
            <span id="detalle_precio_venta"></span>
          </li>

          <li class="list-group-item">
            <strong>Stock:</strong>
            <span id="detalle_stock_producto"></span>
          </li>

          <li class="list-group-item">
            <strong>Estado:</strong>
            <span id="detalle_estado_producto"></span>
          </li>

        </ul>

        <!-- Imagen al final -->
        <div class="text-center mt-3">
          <img id="detalle_imagen_producto" 
               src="" 
               class="img-thumbnail d-none" 
               style="max-height: 120px;">

          <div id="sin_imagen_texto" class="text-muted small d-none">
            Sin foto del producto
          </div>
        </div>

      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn cancelar btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>