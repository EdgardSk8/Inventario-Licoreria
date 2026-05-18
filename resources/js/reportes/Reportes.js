$(document).ready(function () {

    /* EVENTO DE NOMBRAMIENTO DE TITULO */

    $('#titulo').text('REPORTES PARAMETRIZADOS');

    /* INICIALIZACION DE FLATPICKR */

    FlatPickr(FechaInicio);
    flatpickr(FechaFin);

    /* VARIABLES DE ESTADO */

    let cargando = false;
    let tablaReportes = null;
    let requestActual = null;

    /* ESTADO DE MODULO */

    const $fechaInicio = $('#FechaInicio');
    const $fechaFin = $('#FechaFin');
    const $limite = $('#LimiteDatos');
    const Primer_Reporte = $('input[name="reporte"]').first();

    /* MAPEO DE RUTAS */

    const rutasReportes = {
        ventas: '/reportes/ventas',
        inventario: '/reportes/inventario',
        movimientoinventario: '/reportes/movimiento-inventario',
        clientes: '/reportes/clientes',
        usuarios: '/reportes/usuarios',
        cajas: '/reportes/cajas'
    };

    /* FUNCION CONTROL DE FLUJO */

    function recargarReporte() { 
        const reporte = $('input[name="reporte"]:checked').val(); 
        if (reporte) cargarReporte(reporte); 
    }

    const configuracionFiltros = {

    ventas: { columnasSelect: [3, 4, 9, 12] },
    inventario: { columnasSelect: [2, 3, 4] },
    movimientoinventario: { columnasSelect: [2, 5, 6, 9] },
    clientes: { columnasSelect: [1, 4, 8] },
    usuarios: { columnasSelect: [3] },
    cajas: { columnasSelect: [1] }

    };

    const ConfigurarFiltrosDataTable = (tabla, config = {}) => {

        let columnasSelect = config.columnasSelect || [];

        tabla.columns().every(function () {

            let column = this;
            let index = column.index();
            let footer = $(column.footer());
            footer.empty();

            if(columnasSelect.includes(index)){

                let select = $(`<select class="form-select form-select-sm filtro-columna"> <option value="">Todos</option> </select>`)
                .appendTo(footer)
                .on('change', function () {
                    let val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                });

                let valores = [];
                column.data().each(function (d) {
                    d = $('<div>').html(d).text().trim();
                    if(d && !valores.includes(d)){ valores.push(d); }
                });

                valores.sort();
                valores.forEach(function (d) {
                    select.append( `<option value="${d}">${d}</option>` );
                });

            }

            // =========================
            // INPUT
            // =========================

            else{

                $(`
                    <input 
                        type="text" 
                        class="form-control form-control-sm filtro-columna" 
                        placeholder="Buscar"
                    >
                `)
                .appendTo(footer)
                .on('keyup change clear', function () {

                    if(column.search() !== this.value){

                        column
                            .search(this.value)
                            .draw();

                    }

                });

            }

        });

    };

    function cargarReporte(reporte) {

        if (cargando) return;
        cargando = true;

        if (requestActual) { requestActual.abort(); }

        requestActual = $.ajax({

            url: rutasReportes[reporte], type: 'GET',
            data: {
                fecha_inicio: $fechaInicio.val(),
                fecha_fin: $fechaFin.val(),
                limite: $limite.val() !== '' ? $limite.val() : null
            },

            success: function (respuesta) {

                cargando = false;
                if (!respuesta.success) return;

                if (!respuesta.datos || !respuesta.columnas) { console.error("RESPUESTA INVÁLIDA:", respuesta); return; }
                destruirTabla();

                $('#Orden-Datos').on('change', function () {
                    let orden = $(this).val();
                    tablaReportes.order([0, orden]).draw(); 
                });

                /* GENERAR THEAD Y TFOOT DINAMICOS */
                let thead = '<tr>';
                let tfoot = '<tr>';

                respuesta.columnas.forEach(col => {

                    thead += `<th>${col.title}</th>`;
                    tfoot += `<th></th>`;

                });

                thead += '</tr>';
                tfoot += '</tr>';

                $('#Reportes').html(`
                    <thead>${thead}</thead>
                    <tfoot>${tfoot}</tfoot>
                    <tbody></tbody>
                `);


                tablaReportes = $('#Reportes').DataTable({

                    ajax: function (data, callback) {

                        if (requestActual) requestActual.abort();

                        requestActual = $.ajax({
                            url: rutasReportes[reporte], type: 'GET',

                            data: {
                                fecha_inicio: $fechaInicio.val(),
                                fecha_fin: $fechaFin.val(),
                                limite: $limite.val() || null
                            },

                            success: function (respuesta) { callback({ data: respuesta.datos }); }
                        });
                    },

                    /* CONFIGURAR FILTROS */
                    initComplete: function () {

                        ConfigurarFiltrosDataTable(
                            tablaReportes,
                            configuracionFiltros[reporte] || {}
                        );
                    },
                    columns: respuesta.columnas.map(c => ({ data: c.data, title: c.title, defaultContent: "" })),
                    pageLength: 20, dom: 'Bt', buttons: generarBotones(reporte), 
                    columnDefs: [ { targets: "_all", defaultContent: "" } ]
                    

                });

            },

            error: function (xhr, status) {

                cargando = false;
                if (status !== 'abort') { console.error("ERROR AJAX:", xhr.responseText); }
            }

        });
    }

    /* GESTION DE ESTADO UI */

    function destruirTabla() {

        if (tablaReportes) { tablaReportes.clear(); tablaReportes.destroy(); tablaReportes = null; }
        $('#Reportes').empty(); $('#Reportes thead').empty(); $('#Reportes tbody').empty();

    }

    /* FUNCION UTILITARIA */

    function generarNombreArchivo(reporte) {

        const limpio = (reporte || 'REPORTE')
            .toString()
            .toUpperCase()
            .replace(/\s+/g, '_')
            .replace(/[^\w_]/g, '');

        const fecha = window.formatearFechaDiaHora(new Date(), true);
        return `REPORTE DE ${limpio} ${fecha}`;
    }

    function generarBotones(reporte) {

        const nombre = generarNombreArchivo(reporte);

        return [

            PlantillaExcel({ filename: nombre, title: nombre }),
            PlantillaPDF({ filename: nombre, title: nombre }),
            PlantillaCSV({ filename: nombre, title: nombre }),

            { extend: 'copyHtml5', text: '📋 Copiar', className: 'btn btn-secondary' },
            { extend: 'print', text: '🖨️ Imprimir', className: 'btn btn-dark' }

        ];
    }

    /* MANEJO DE EVENTOS */

    $(document).on('change', 'input[name="reporte"]', function () { cargarReporte($(this).val()); });
    $('#limpiafiltroreporte').on('click', function () { $fechaInicio.val(''); $fechaFin.val(''); $limite.val(''); recargarReporte(); });

    $fechaInicio.add($fechaFin).on('change', function () {

        const inicio = $fechaInicio.val();
        const fin = $fechaFin.val();

        if ( (inicio && !fin) || (!inicio && fin) ) {

            Swal.fire({
                icon: 'warning',
                title: 'Fechas incompletas',
                text: 'Debes seleccionar fecha de inicio y fecha fin.'
            });

            return;
        }

        recargarReporte();

    });

    $limite.on('input', recargarReporte);

    if (Primer_Reporte.length) { Primer_Reporte.prop('checked', true); cargarReporte(Primer_Reporte.val()); }
    
});