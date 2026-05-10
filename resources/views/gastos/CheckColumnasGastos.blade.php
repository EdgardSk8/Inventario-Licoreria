<div class="d-flex justify-content-between align-items-center">

<div class="d-flex align-items-center gap-3">

    <div class="dropdown">

        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"> Columnas </button>

        <div class="dropdown-menu p-3 dropdown-columns">

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="0" id="colNombre" checked>
                <label class="form-check-label" for="colNombre">Nombre</label>
            </div>

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="1" id="colTipo" checked>
                <label class="form-check-label" for="colTipo">Tipo</label>
            </div>

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="2" id="colDescripcion">
                <label class="form-check-label" for="colDescripcion">Descripción</label>
            </div>

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="3" id="colFechaPago" checked>
                <label class="form-check-label" for="colFechaPago">Fecha pago</label>
            </div>

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="4" id="colEstadoPago" checked>
                <label class="form-check-label" for="colEstadoPago">Estado pago</label>
            </div>

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="5" id="colUltimoPago" checked>
                <label class="form-check-label" for="colUltimoPago">Último pago</label>
            </div>

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="6" id="colMonto" checked>
                <label class="form-check-label" for="colMonto">Monto</label>
            </div>

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="7" id="colEstado">
                <label class="form-check-label" for="colEstado">Estado</label>
            </div>

            <div class="form-check">
                <input class="form-check-input toggle-col" type="checkbox" data-column="8" id="colAcciones" checked>
                <label class="form-check-label" for="colAcciones">Acciones</label>
            </div>

        </div>

    </div>

        <button type="button"
            class="btn-agregar"
            data-bs-toggle="modal"
            data-bs-target="#modalCrearGasto">
            + Agregar Gasto
        </button>

        <input type="checkbox" id="toggleInactivosGastos" class="togglecheck" hidden checked>
            <label for="toggleInactivosGastos" class="toggle-btn"> Ocultar inactivos </label>
        </div>

</div>