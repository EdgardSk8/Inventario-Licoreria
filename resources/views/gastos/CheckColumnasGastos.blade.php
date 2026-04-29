<div class="d-flex justify-content-between align-items-center mb-3">

    <!-- DERECHA: columnas -->
    <div class="d-flex flex-wrap align-items-center gap-3">

     <button type="button"
            class="btn btn-sm btn-dark"
            data-bs-toggle="modal"
            data-bs-target="#modalCrearGasto">
            + Agregar Gasto
        </button>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="0" checked>
            <label class="form-check-label">Nombre</label>
        </div>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="1" checked>
            <label class="form-check-label">Tipo</label>
        </div>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="2">
            <label class="form-check-label">Descripción</label>
        </div>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="3" checked>
            <label class="form-check-label">Fecha pago</label>
        </div>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="4" checked>
            <label class="form-check-label">Estado pago</label>
        </div>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="5" checked>
            <label class="form-check-label">Último pago</label>
        </div>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="6" checked>
            <label class="form-check-label">Monto</label>
        </div>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="7">
            <label class="form-check-label">Estado</label>
        </div>

        <div class="form-check m-0">
            <input class="form-check-input toggle-col" type="checkbox" data-column="8" checked>
            <label class="form-check-label">Acciones</label>
        </div>

        <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" id="toggleInactivosGastos" checked>
            <label class="form-check-label" for="toggleInactivosGastos">
                Ocultar inactivos
            </label>
        </div>

    </div>

</div>