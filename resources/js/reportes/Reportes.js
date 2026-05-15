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

                    columns: respuesta.columnas.map(c => ({ data: c.data, title: c.title, defaultContent: "" })),
                    pageLength: 10, dom: 'Bt', buttons: generarBotones(reporte), order:[0, "desc"],
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