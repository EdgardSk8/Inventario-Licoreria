$(document).ready(function () {

    document.getElementById('titulo').textContent = 'HISTORIAL DE VENTAS';

    $('#tablaVentas').DataTable({

        responsive: true,

        processing: true,

        ajax: { url: '/ventas/mostrar', type: 'GET', dataSrc: 'ventas' },

        columns: [ { data: 'numero_factura' },
            { data: 'cliente.nombre_cliente'},
            { data: 'usuario.nombre_usuario' },
            { data: 'fecha_venta', render: function(data){ return formatearFecha(data); } },
            { data: 'subtotal_venta' },
            { data: 'impuesto_venta' },
            { data: 'total_venta' },
            { data: 'metodo_pago.nombre_metodo_pago' },
            { data: 'estado_venta', render: function(data){ return data == 1 ? 'Activa' : 'Anulada';} },
            {
                data: 'id_venta',
                render: function(data){
                    return `
                        <button class="btn detalle btn-detalle" data-id="${data}">
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
            { targets: 9, visible: $('.toggle-col[data-column="9"]').is(':checked') }
        ],
        order: [[0, 'desc']],
        ...Traduccion // Constante de traduccion de datatables
    }); // Fin de datatables

    $('.toggle-col').on('change', function () {
        let column = $('#tablaVentas').DataTable().column($(this).data('column'));
        column.visible(this.checked);
    });

});