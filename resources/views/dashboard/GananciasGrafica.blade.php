<div class="dashboard">

    <div class="dashboard-header">

        <h2 class="dashboard-title">Ganancias</h2>

        <div class="dashboard-filtros">

            <!-- 🔹 filtro principal -->
            <select class="select" id="Filtro-Ganancias">

                <option value="dia">Ganancias por día</option>
                <option value="mes">Ganancias por mes</option>
                <option value="anio">Ganancias por año</option>
                <option value="hora">Ganancias por hora</option>
<!-- 
                <option value="top_productos">Top productos rentables</option>
                <option value="categorias">Ganancia por categoría</option>
                <option value="usuarios">Ganancia por usuario</option>
                <option value="clientes">Ganancia por cliente</option> -->

            </select>

            <!-- 🔹 tipo de gráfica -->
            <select class="select" id="Tipo-Grafica-Ganancias">

                <option value="bar">Barras</option>
                <option value="line">Línea</option>
                <option value="pie">Pastel</option>
                <option value="doughnut">Dona</option>
                <option value="radar">Radar</option>
                <option value="polarArea">Área Polar</option>

            </select>

            <!-- 🔥 FILTROS JERÁRQUICOS -->
            <select class="select" id="Select-Anio-Ganancias"></select>

            <select class="select" id="Select-Mes-Ganancias" disabled></select>

            <select class="select" id="Select-Dia-Ganancias" disabled></select>

            <!-- 🔥 RANGO FECHAS -->
            <input 
                type="date" 
                class="dashboard-input" 
                placeholder="Fecha Inicio"
                id="Fecha-Inicio-Ganancias"
            >

            <input 
                type="date" 
                placeholder="Fecha fin"
                class="dashboard-input" 
                id="Fecha-Fin-Ganancias"
            >

            <!-- 🔄 LIMPIAR -->
            <button type="button" class="dashboard-btn" id="BTN-Limpiar-Ganancias">
                Limpiar filtros
            </button>

        </div>

    </div>

    <div class="dashboard-kpis">

        <div class="kpi-card">
            <span class="kpi-title">Ganancia total:</span>
            <span class="dato" id="kpi-ganancia-total">C$ 0.00</span>
        </div>

        <div class="kpi-card">
            <span class="kpi-title">Ingresos:</span>
            <span class="dato" id="kpi-ingresos">C$ 0.00</span>
        </div>

        <div class="kpi-card">
            <span class="kpi-title">Ganancia por unidad:</span>
            <span class="dato" id="kpi-ganancia-unidad">C$ 0.00</span>
        </div>

        <div class="kpi-card">
            <span class="kpi-title">Rentabilidad (Venta %):</span>
            <span class="dato" id="kpi-margen-venta">0%</span>
        </div>

        <div class="kpi-card">
            <span class="kpi-title">Ventas totales:</span>
            <span class="dato" id="kpi-ventas-totales">0</span>
        </div>

    </div>

    <!-- 📊 GRÁFICA -->
    <div class="dashboard-chart">
        <canvas id="chartGanancias"></canvas>
    </div>

</div>