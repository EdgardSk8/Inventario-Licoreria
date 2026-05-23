<div class="dashboard">

    <div class="dashboard-header">

        <h2 class="dashboard-title">Inventario</h2>

        <div class="dashboard-filtros">

            <!-- 🔹 filtro principal (movimientos) -->
            <select class="select" id="Filtro-Inventario">

                <option value="dia">Movimientos por día</option>
                <option value="mes">Movimientos por mes</option>
                <option value="anio">Movimientos por año</option>

            </select>

            <!-- 🔹 tipo de gráfica -->
            <select class="select" id="Tipo-Grafica-Inventario">
                <option value="bar">Barras</option>
                <option value="line">Línea</option>
                <option value="pie">Pastel</option>
                <option value="doughnut">Dona</option>
                <option value="radar">Radar</option>
                <option value="polarArea">Área Polar</option>
            </select>

            <!-- 🔥 FILTRO JERÁRQUICO -->
            <select class="select" id="Select-Anio-Inventario"></select>

            <select class="select" id="Select-Mes-Inventario" disabled></select>

            <select class="select" id="Select-Dia-Inventario" disabled></select>

            <!-- 🔥 RANGO FECHAS -->
            <input 
                type="date" 
                class="dashboard-input" 
                placeholder="Fecha inicio"
                id="Fecha-Inicio-Inventario"
            >

            <input 
                type="date" 
                class="dashboard-input" 
                placeholder="Fecha Fin"
                id="Fecha-Fin-Inventario"
            >

            <button type="button" class="dashboard-btn" id="BTN-Limpiar-Inventario">
                Limpiar filtros
            </button>

        </div>

        <div class="dashboard-kpis">

            <div class="kpi-card">
                <span class="kpi-title">Movimientos:</span>
                <span id="kpi-total-movimientos" class="dato">0</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Entradas: </span>
                <span id="kpi-entradas" class="dato">0</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Salidas: </span>
                <span id="kpi-salidas" class="dato">0</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Ajuste: </span>
                <span id="kpi-ajustes" class="dato">0</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Balance:</span>
                <span id="kpi-balance" class="dato">0</span>
            </div>

            <div class="kpi-card">
                <span class="kpi-title">Promedio:</span>
                <span id="kpi-promedio" class="dato">0</span>
            </div>

        </div>

    </div>

    <div class="dashboard-chart">
        <canvas id="Chart-Inventario"></canvas>
    </div>

</div>