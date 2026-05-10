<div class="d-flex justify-content-between align-items-center gap-3">

    <div class="d-flex align-items-center gap-3">

        <!-- Dropdown columnas -->
        <div class="dropdown">

            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Columnas
            </button>

            <div class="dropdown-menu p-3 dropdown-columns">

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="0" id="colNombre" checked>
                    <label class="form-check-label" for="colNombre">Nombre</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="1" id="colCedula" checked>
                    <label class="form-check-label" for="colCedula">Cédula</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="2" id="colRuc" checked>
                    <label class="form-check-label" for="colRuc">RUC</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="3" id="colTelefono" checked>
                    <label class="form-check-label" for="colTelefono">Teléfono</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="4" id="colCorreo" checked>
                    <label class="form-check-label" for="colCorreo">Correo</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="5" id="colEstado" checked>
                    <label class="form-check-label" for="colEstado">Estado</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="6" id="colAcciones" checked>
                    <label class="form-check-label" for="colAcciones">Acciones</label>
                </div>

            </div>

        </div>

        <!-- Botón agregar (manteniendo tu estilo consistente) -->
        <button type="button" class="btn-agregar" data-bs-toggle="modal" data-bs-target="#modalCrearCliente">
            + Agregar Cliente
        </button>

        <!-- Toggle inactivos (CORRECTO según tu CSS existente) -->
        <input type="checkbox" id="toggleInactivosClientes" class="togglecheck" hidden checked>
        <label for="toggleInactivosClientes" class="toggle-btn">
            Ocultar inactivos
        </label>

    </div>

</div>