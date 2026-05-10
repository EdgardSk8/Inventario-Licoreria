<div class="d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center gap-3">

        <!-- Dropdown columnas -->
        <div class="dropdown">

            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Columnas
            </button>

            <div class="dropdown-menu p-3 dropdown-columns">

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="0" id="colCaja" checked>
                    <label class="form-check-label" for="colCaja">Nº Caja</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="1" id="colUsuario" checked>
                    <label class="form-check-label" for="colUsuario">Usuario</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="2" id="colFechaApertura" checked>
                    <label class="form-check-label" for="colFechaApertura">Fecha Apertura</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="3" id="colFechaCierre" checked>
                    <label class="form-check-label" for="colFechaCierre">Fecha Cierre</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="4" id="colMontoInicial" checked>
                    <label class="form-check-label" for="colMontoInicial">Monto Inicial</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="5" id="colMontoFinal" checked>
                    <label class="form-check-label" for="colMontoFinal">Monto Final</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input toggle-col" type="checkbox" data-column="6" id="colEstado" checked>
                    <label class="form-check-label" for="colEstado">Estado</label>
                </div>

            </div>

        </div>

        <!-- Toggle inactivos -->
        <input type="checkbox" id="toggleInactivosCajas" class="togglecheck" hidden checked>
        <label for="toggleInactivosCajas" class="toggle-btn">
            Ocultar inactivos
        </label>

    </div>

</div>