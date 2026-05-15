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

});