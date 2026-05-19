<div class="dashboard">

    <div class="dashboard-header">

        <h2 class="dashboard-title">Ventas</h2>

        <div class="dashboard-filtros">

            <!-- 🔹 filtro principal -->
            <select class="select" id="Filtro-Ventas">

                <option value="dia">Ventas por día</option>
                <option value="mes">Ventas por mes</option>
                <option value="anio">Ventas por año</option>
                <option value="hora">Ventas por hora</option>

                <option value="clientes">Top clientes</option>
                <option value="usuarios">Ventas por usuario</option>
                <option value="metodos_pago">Métodos de pago</option>
                <option value="estado">Estado de ventas</option>
                <option value="dias_fuertes">Días más fuertes</option>

            </select>

            <!-- 🔹 tipo de gráfica -->
            <select class="select" id="Tipo-Grafica-Ventas">
                <option value="bar">Barras</option>
                <option value="line">Línea</option>
                <option value="pie">Pastel</option>
                <option value="doughnut">Dona</option>
                <option value="radar">Radar</option>
                <option value="polarArea">Área Polar</option>
            </select>

            <!-- 🔥 SELECTOR JERÁRQUICO -->
            <select class="select" id="Select-Anio-Ventas"></select>

            <select title="Seleccione un año para desglosar el mes" class="select" id="Select-Mes-Ventas" disabled>
                
            </select>

            <select title="Seleccione un año para desglosar el dia" class="select" id="Select-Dia-Ventas" disabled>
                
            </select>

           
            <input 
                type="date" 
                class="dashboard-input" 
                id="Fecha-Inicio-Ventas"
                placeholder="Fecha inicio"
                autocomplete="off"
            >

            <input 
                type="date" 
                class="dashboard-input" 
                id="Fecha-Fin-Ventas"
                placeholder="Fecha fin"
                autocomplete="off"
            >

            <button type="button" class="dashboard-btn" id="BTN-Limpiar-Ventas">
                Limpiar filtros
            </button>

        </div>

        <div class="dashboard-kpis">

            <div class="kpi-card">
                <span class="kpi-title">Total ventas:</span>
                <span class="dato" id="kpi-total-ventas">0</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Ingresos:</span>
                <span class="dato" id="kpi-ingresos-venta">C$ 0.00</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Unidades vendidas:</span>
                <span class="dato" id="kpi-unidades-vendidas">0</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Promedio por venta:</span>
                <span class="dato" id="kpi-promedio-venta">C$ 0.00</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Venta más alta:</span>
                <span class="dato" id="kpi-venta-maxima">C$ 0.00</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Impuestos</span>
                <span class="dato" id="kpi-impuestos">C$ 0.00</span>
            </div>

        </div>

    <div class="dashboard-chart">
        <canvas id="chartVentas"></canvas>
    </div>

</div>