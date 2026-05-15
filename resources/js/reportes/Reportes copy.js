
$(document).ready(function () {

    document.getElementById('titulo').textContent = 'REPORTES PARAMETRIZADOS';

    FlatPickr(FechaInicio);
    FlatPickr(FechaFin);
    // =====================================================
    // VARIABLES
    // =====================================================

    let tablaReportes = null;

    const rutasReportes = {

        ventas: '/reportes/ventas',
        inventario: '/reportes/inventario',
        movimientoinventario: '/reportes/movimiento-inventario',
        clientes: '/reportes/clientes',
        usuarios: '/reportes/usuarios',
        cajas: '/reportes/cajas'

    };

    // =====================================================
    // EVENTOS
    // =====================================================

    $('input[name="reporte"]').on('change', function () {

        const reporte = $(this).val();

        CargarReporte(reporte);

    });

    $('#FechaInicio, #FechaFin').on('change', function () {

        const reporte = $('input[name="reporte"]:checked').val();

        if (reporte) {
            CargarReporte(reporte);
        }

    });

    $('#LimiteDatos').on('input', function () {

        const reporte = $('input[name="reporte"]:checked').val();

        if (reporte) {
            CargarReporte(reporte);
        }

    });

    const primerReporte = $('input[name="reporte"]').first();
    primerReporte.prop('checked', true).trigger('change');
    // =====================================================
    // FUNCION PRINCIPAL
    // =====================================================

    function CargarReporte(reporte) {

        const ruta = rutasReportes[reporte];

        if (!ruta) {
            console.error('Ruta no encontrada');
            return;
        }

        $.ajax({

            url: ruta,

            type: 'GET',

            data: {

                fecha_inicio: $('#FechaInicio').val(),
                fecha_fin: $('#FechaFin').val(),
                limite: $('#LimiteDatos').val()

            },

            beforeSend: function () {

                $('#Reportes tbody').html(`
                    <tr>
                        <td colspan="100" class="text-center py-4">
                            Cargando reporte...
                        </td>
                    </tr>
                `);

            },

            success: function (respuesta) {

                if (!respuesta.success) {

                    console.error(respuesta);
                    return;

                }

                if ($.fn.DataTable.isDataTable('#Reportes')) {
                    tablaReportes.destroy();
                    $('#Reportes').empty();
                }

                let thead = '<thead><tr>';
                respuesta.columnas.forEach(columna => {
                    thead += `<th>${columna.title}</th>`;
                });
                thead += '</tr></thead>';


                let tfoot = '<tfoot><tr>';
                respuesta.columnas.forEach(() => {
                    tfoot += '<th></th>';
                });
                tfoot += '</tr></tfoot>';

                $('#Reportes').html(thead + '<tbody></tbody>' + tfoot);

                tablaReportes = $('#Reportes').DataTable({

                    data: respuesta.datos,

                    columns: respuesta.columnas,
                    pageLength: 10,
                    lengthMenu: [
                        [10],
                        [10]
                    ],
                     dom: 'Bt',

                    destroy: true,

                    order: [[0, 'desc']],


                    createdRow: function (row, data) {

                        // =============================================
                        // ESTADOS
                        // =============================================

                        if (data.estado === 'Activa') {

                            $('td', row).last().addClass('text-success fw-bold');

                        }

                        if (data.estado === 'Cancelada') {

                            $('td', row).last().addClass('text-danger fw-bold');

                        }

                        // =============================================
                        // GANANCIA
                        // =============================================

                        if (data.porcentaje_ganancia) {

                            const porcentaje = parseFloat(data.porcentaje_ganancia);

                            $('td', row).each(function () {

                                if ($(this).text() === data.porcentaje_ganancia) {

                                    if (porcentaje >= 40) {
                                        $(this).addClass('text-success fw-bold');
                                    }

                                    else if (porcentaje >= 20) {
                                        $(this).addClass('text-warning fw-bold');
                                    }

                                    else {
                                        $(this).addClass('text-danger fw-bold');
                                    }

                                }

                            });

                        }

                    },

                    footerCallback: function () {

                        const api = this.api();

                        const tfoot = respuesta.tfoot;

                        if (!tfoot) return;

                        let textoFooter = '';

                        Object.entries(tfoot).forEach(([clave, valor]) => {

                            textoFooter += `
                                <div class="justify-content-between gap-1">
                                    <strong>${FormatearTexto(clave)}:</strong>
                                    <span class="text-success">${valor}</span>
                                </div>
                            `;

                        });

                        $(api.table().footer()).html(`
                            <tr>
                                <th colspan="${respuesta.columnas.length}"> 
                                    <div class="footer-reportes">
                                        ${textoFooter}
                                    </div>
                                </th>
                            </tr>
                        `);

                    }

                });

            },

            error: function (xhr) {

                console.error(xhr.responseText);

                $('#Reportes tbody').html(`
                    <tr>
                        <td colspan="100" class="text-center text-danger py-4">
                            Error al cargar reporte
                        </td>
                    </tr>
                `);

            }

        });

    }

    // =====================================================
    // HELPERS
    // =====================================================

    function FormatearTexto(texto) {

        return texto
            .replaceAll('_', ' ')
            .replace(/\b\w/g, l => l.toUpperCase());

    }

});

$(document).ready(function () {

    // =====================================================
    // EXPORTACION
    // =====================================================

    $('input[name="tipo_exportacion"]').on('change', function () {

        $('#btnGenerarReporte').prop('disabled', false);

    });

    // =====================================================
    // GENERAR
    // =====================================================

    $('#btnGenerarReporte').on('click', function () {

        const tipo = $('input[name="tipo_exportacion"]:checked').val();

        if (!tipo) {

            alert('Seleccione un tipo de exportación');
            return;

        }

        if (!$.fn.DataTable.isDataTable('#Reportes')) {

            alert('No hay datos cargados');
            return;

        }

        const tabla = $('#Reportes').DataTable();

        // =====================================================
        // PDF
        // =====================================================

        if (tipo === 'pdf') {

            tabla.button('.buttons-pdf').trigger();

        }

        // =====================================================
        // EXCEL
        // =====================================================

        if (tipo === 'excel') {

           tabla.button('.buttons-excel').trigger();

        }

    });

})

buttons: [

    PlantillaExcel({

        filename: `Reporte_${reporteActual}`,

        empresa: 'Licorería El Buen Trago',

        reporte: FormatearTexto(reporteActual),

        fechaInicio: $('#FechaInicio').val(),

        fechaFin: $('#FechaFin').val(),

        usuario: 'Administrador',

        totalRegistros: respuesta.datos.length

    }),

    {
        extend: 'pdfHtml5',
        text: '📄 PDF',
        className: 'btn btn-danger',
        orientation: 'landscape',
        pageSize: 'A4',
        footer: true
    }

]

