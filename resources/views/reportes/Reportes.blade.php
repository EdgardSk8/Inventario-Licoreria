<link rel="stylesheet" href="{{ Vite::asset('resources/css/reportes/Reportes.css') }}">

<script src="{{ Vite::asset('resources/js/reportes/ExportarReportes.js') }}"></script>
<script src="{{ Vite::asset('resources/js/reportes/Plantillas.js') }}"></script>
<script src="{{ Vite::asset('resources/js/reportes/Reportes.js') }}"></script>
<div class="contenedor-principal">


    <!-- ╔════════════════════════════════════╗
        ║         CARDS REPORTES            ║
        ╚════════════════════════════════════╝ -->

    <div class="contenedor-reportes">

        <!-- VENTAS -->
        <input type="radio" name="reporte" id="ventas" value="ventas" hidden>

        <label for="ventas" class="card-reporte ventas">
            <span>📈</span>
            <small>Ventas</small>
        </label>

        <!-- INVENTARIO -->
        <input type="radio" name="reporte" id="inventario" value="inventario" hidden>

        <label for="inventario" class="card-reporte inventario">
            <span>📦</span>
            <small>Inventario</small>
        </label>

        <!-- MOVIMIENTOS -->
        <input type="radio" name="reporte" id="movimientos" value="movimientoinventario" hidden>

        <label for="movimientos" class="card-reporte movimientos">
            <span>🔄</span>
            <small>Movimientos</small>
        </label>

        <!-- CLIENTES -->
        <input type="radio" name="reporte" id="clientes" value="clientes" hidden>

        <label for="clientes" class="card-reporte clientes">
            <span>👤</span>
            <small>Clientes</small>
        </label>

        <!-- USUARIOS -->
        <input type="radio" name="reporte" id="usuarios" value="usuarios" hidden>

        <label for="usuarios" class="card-reporte usuarios">
            <span>👨‍💼</span>
            <small>Usuarios</small>
        </label>

        <!-- CAJAS -->
        <input type="radio" name="reporte" id="cajas" value="cajas" hidden>

        <label for="cajas" class="card-reporte cajas">
            <span>💰</span>
            <small>Cajas</small>
        </label>

        <!-- ---------------------------------------------------------------------------------------- -->


        <!-- <div class="contenedor-radio-exportar">

            <input type="radio" name="tipo_exportacion" id="exportExcel" value="excel" hidden>
            <label for="exportExcel" class="radio-exportacion excel"> 📊 Excel </label>

            <input type="radio" name="tipo_exportacion" id="exportPDF" value="pdf" hidden >
            <label for="exportPDF" class="radio-exportacion pdf"> 📄 PDF </label>
            
            <button id="btnGenerarReporte" class="btn-reporte" disabled> Generar </button>

        </div> -->

        <!-- ---------------------------------------------------------------------------------------- -->

    </div>

   <!-- ╔════════════════════════════════════╗
        ║             FILTROS               ║
        ╚════════════════════════════════════╝ -->

    <div class="contenedor-filtros">

        <!-- FECHA INICIO -->
        <div class="grupo-filtro">

            <label class="label-filtro"> Fecha Inicio </label>
            <input type="date" id="FechaInicio" placeholder="Fecha inicio"
                autocomplete="off" class="Fecha-Input-Reporte">

        </div>

        <!-- FECHA FIN -->
        <div class="grupo-filtro">

            <label class="label-filtro"> Fecha Fin</label>
               
            <input type="date" id="FechaFin"  autocomplete="off"  placeholder="Fecha Fin"  class="Fecha-Input-Reporte">

        </div>

        <!-- LIMITE -->
        <div class="grupo-filtro">

            <label class="label-filtro"> Cantidad Datos </label>
            <input type="number" id="LimiteDatos" class="form-control form-control-sm" min="1" value="">

            <button id="limpiafiltroreporte" class="btn-reporte">Limpiar Filtros</button>

        </div>

    </div>


        <table id="Reportes" class="table table-striped table-bordered">

            <thead></thead>
            <tbody></tbody>

        </table>

    
    

</div>
