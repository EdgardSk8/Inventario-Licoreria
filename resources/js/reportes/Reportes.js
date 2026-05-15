$(document).ready(function () {

    $('#titulo').text('REPORTES PARAMETRIZADOS');

    FlatPickr(FechaInicio);
    flatpickr(FechaFin);


    let cargando = false;
    let tablaReportes = null;
    let requestActual = null; // 🔥 evita respuestas viejas

    const $fechaInicio = $('#FechaInicio');
    const $fechaFin = $('#FechaFin');
    const $limite = $('#LimiteDatos');

    $('#limpiafiltroreporte').on('click', function () {
        $fechaInicio.val(''); $fechaFin.val(''); $limite.val(''); recargarReporte();
    });

    const rutasReportes = {
        ventas: '/reportes/ventas',
        inventario: '/reportes/inventario',
        movimientoinventario: '/reportes/movimiento-inventario',
        clientes: '/reportes/clientes',
        usuarios: '/reportes/usuarios',
        cajas: '/reportes/cajas'
    };

    // =====================================
    // EVENTOS
    // =====================================

    $(document).on('change', 'input[name="reporte"]', function () {
        cargarReporte($(this).val());
    });

    $fechaInicio.add($fechaFin).on('change', recargarReporte);
    $limite.on('input', recargarReporte);

    const primer = $('input[name="reporte"]').first();
    if (primer.length) {
        primer.prop('checked', true);
        cargarReporte(primer.val());
    }

    function recargarReporte() {
        const reporte = $('input[name="reporte"]:checked').val();
        if (reporte) cargarReporte(reporte);
    }

    // =====================================
    // DESTRUIR TABLA REAL
    // =====================================

    function destruirTabla() {

        if (tablaReportes) {
            tablaReportes.clear();
            tablaReportes.destroy();
            tablaReportes = null;
            
        }

        // 🔥 CLAVE: limpiar DOM completamente
        $('#Reportes').empty();
        $('#Reportes thead').empty();
        $('#Reportes tbody').empty();
    }

    // =====================================
    // CARGAR REPORTE
    // =====================================

    function cargarReporte(reporte) {

        if (cargando) return;
        cargando = true;

        // 🔥 CANCELAR REQUEST ANTERIOR
        if (requestActual) {
            requestActual.abort();
        }

        requestActual = $.ajax({
            url: rutasReportes[reporte],
            type: 'GET',
            data: {
                fecha_inicio: $fechaInicio.val(),
                fecha_fin: $fechaFin.val(),
                limite: $limite.val() !== '' ? $limite.val() : null
            },

            success: function (respuesta) {

                cargando = false;

                if (!respuesta.success) return;

                // =====================================
                // VALIDACIÓN DEFENSIVA
                // =====================================

                if (!respuesta.datos || !respuesta.columnas) {
                    console.error("RESPUESTA INVÁLIDA:", respuesta);
                    return;
                }

                // =====================================
                // RESET TOTAL
                // =====================================

                destruirTabla();

                // =====================================
                // INIT DATATABLE
                // =====================================

        tablaReportes = $('#Reportes').DataTable({

            ajax: function (data, callback) {

                if (requestActual) requestActual.abort();

                requestActual = $.ajax({
                    url: rutasReportes[reporte],
                    type: 'GET',
                    data: {
                        fecha_inicio: $fechaInicio.val(),
                        fecha_fin: $fechaFin.val(),
                        limite: $limite.val() || null
                    },

                    success: function (respuesta) {
                        callback({ data: respuesta.datos });
                    }
                });
            },

            columns: respuesta.columnas.map(c => ({
                data: c.data,
                title: c.title,
                defaultContent: ""
            })),

            pageLength: 10,
            order: [[0, 'desc']],
            dom: 'Bt',
            buttons: generarBotones(reporte),

            columnDefs: [
                { targets: "_all", defaultContent: "" }
            ]
        });
            },

            error: function (xhr, status) {

                cargando = false;

                if (status !== 'abort') {
                    console.error("ERROR AJAX:", xhr.responseText);
                }
            }
        });
    }

    // =====================================
    // BOTONES
    // =====================================

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

});