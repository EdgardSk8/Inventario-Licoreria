<div class="modal fade" id="modalPagarGasto" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Pagar Gasto</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form id="formPagarGasto" class="row g-3">

          <!-- ID oculto -->
          <input type="hidden" id="pagar_id_gasto">

          <!-- Nombre gasto -->
          <div class="col-4">
            <label class="form-label">Nombre del Gasto</label>
            <input type="text"
                   id="pagar_nombre_gasto"
                   class="form-control form-control-sm"
                   disabled>
          </div>

          <!-- Último pago -->
          <div class="col-md-4">
            <label class="form-label">Último Pago</label>
            <input type="text"
                   id="pagar_ultimo_pago"
                   class="form-control form-control-sm"
                   disabled>
          </div>

          <!-- Último monto -->
          <div class="col-md-4">
            <label class="form-label">Último Monto</label>
            <input type="text"
                   id="pagar_ultimo_monto"
                   class="form-control form-control-sm"
                   disabled>
          </div>

         
          <!-- Método -->
          <div class="col-md-6">
            <label class="form-label">Pagar con Caja</label>
            <select id="pagar_id_caja" class="form-select form-select-sm">
              <option value="">Seleccione</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Pagar con Cuenta</label>
            <select id="pagar_id_cuenta" class="form-select form-select-sm">
              <option value="">Seleccione</option>
            </select>
          </div>

           <!-- Monto nuevo pago -->
          <div class="col-md-4">
            <label class="form-label">Monto a Pagar</label>
            <input type="number"
                   id="pagar_monto"
                   class="form-control form-control-sm"
                   min="0"
                   step="0.5"
                   required>
          </div>

          <!-- 🔁 Renovación de fecha -->
<div class="col-8">

  <label class="form-label">Renovación de vencimiento</label>

  <select id="pagar_renovar_fecha" class="form-select form-select-sm">
    <option value="auto">Automático ( +1 mes )</option>
    <option value="manual">Elegir fecha manual</option>
  </select>

</div>

<!-- fecha manual (oculto por defecto) -->
<div class="col-12 d-none" id="grupo_fecha_manual">

  <label class="form-label">Nueva fecha de vencimiento</label>

  <input type="date"
         id="pagar_nueva_fecha"
         class="form-control form-control-sm">

</div>

        </form>

      </div>

        <div class="modal-footer d-flex justify-content-between">

          <small class="text-muted">
            Debe seleccionar caja o cuenta
          </small>

          <div>
            <button class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn guardar" id="btnPagarGasto">
              Pagar
            </button>
          </div>

      </div>

      

    </div>

  </div>

</div>