$(document).ready(function () {

    document.getElementById('titulo').textContent = 'HISTORIAL DE VENTAS';

    $('#tablaVentas').DataTable({

        ajax: { url: '/ventas/mostrar', type: 'GET', dataSrc: 'ventas' },

        columns: [
            { data: 'id_venta' },
            { data: 'numero_factura' },
            { data: 'cliente.nombre_cliente'},
            { data: 'usuario.nombre_usuario' },
            { data: 'fecha_venta', render: function(data){ return formatearFecha(data); } },
            { data: 'subtotal_venta', render: data => moneda(data) },
            { data: 'impuesto_venta', render: data => moneda(data) },
            { data: 'total_venta', render: data => moneda(data) },
            { data: 'metodo_pago.nombre_metodo_pago' },
            { data: 'estado_venta',
                render: function(data){
                    return data == 1
                        ? '<span class="estado estado-activo">Registrada</span>'
                        : '<span class="estado estado-inactivo">Anulada</span>';
                }
            },

            {
                data: 'id_venta',
                render: function(data){
                    return `
                        <button class="btn detalle-venta btn-detalle" data-id="${data}">
                            <i class="bi bi-eye"></i> Detalle
                        </button>
                    `;
                }
            }
        ], 
        columnDefs: [
            // Configurar visibilidad inicial según checkboxes
            { targets: 0, visible: $('.toggle-col[data-column="0"]').is(':checked') },
            { targets: 1, visible: $('.toggle-col[data-column="1"]').is(':checked') },
            { targets: 2, visible: $('.toggle-col[data-column="2"]').is(':checked') },
            { targets: 3, visible: $('.toggle-col[data-column="3"]').is(':checked') },
            { targets: 4, visible: $('.toggle-col[data-column="4"]').is(':checked') },
            { targets: 5, visible: $('.toggle-col[data-column="5"]').is(':checked') },
            { targets: 6, visible: $('.toggle-col[data-column="6"]').is(':checked') },
            { targets: 7, visible: $('.toggle-col[data-column="7"]').is(':checked') },
            { targets: 8, visible: $('.toggle-col[data-column="8"]').is(':checked') },
            { targets: 9, visible: $('.toggle-col[data-column="9"]').is(':checked') },
            { targets: 10, visible: $('.toggle-col[data-column="10"]').is(':checked') }
        ], // Constante de traduccion de datatables
        order: [[0, 'desc']],
        initComplete: function () {
            ConfigurarFiltrosDataTable(this, { columnasSelect: [2,3, 8], columnasIgnorar: [10] });
        }
    }); // Fin de datatables

    $('.toggle-col').on('change', function () {
        let column = $('#tablaVentas').DataTable().column($(this).data('column'));
        column.visible(this.checked);
    });

});