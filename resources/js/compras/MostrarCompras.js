$(document).ready(function () {

    document.getElementById('titulo').textContent = 'HISTORIAL DE COMPRAS';

    $('#tablaCompras').DataTable({
        ajax: { url: '/compras/mostrar', type: 'GET', dataSrc: 'compras' },

        columns: [

            { data: 'id_compra', visible: false },
            { data: 'numero_factura_compra' },

            { data: 'proveedor.nombre_proveedor' },

            { data: 'usuario.nombre_usuario' },

            { data: 'fecha_compra', render: function (data) { return formatearFecha(data); } },

            { data: 'subtotal_compra' },

            {
                data: 'descuento_compra',
                render: function (data) {
                    return (data == null || data == 0 || data === '') ? '-' : data;
                }
            },

            { data: 'impuesto_compra' },

            { data: 'total_compra' },

            { data: 'metodo_pago.nombre_metodo_pago' },

            {
                data: 'estado_compra',
                render: function (data) {
                    return data == 1
                        ? '<span class="estado estado-activo">Registrada</span>'
                        : '<span class="estado estado-inactivo">Anulada</span>';
                }
            },

            {
                data: 'id_compra',
                render: function (data) {
                    return `
                        <button class="btn detalle-compra btn-detalle" data-id="${data}">
                            <i class="bi bi-eye"></i> Detalle
                        </button>
                    `;
                }
            }
        ],

        columnDefs: [
            
            { targets: 1, visible: $('.toggle-col[data-column="1"]').is(':checked') },
            { targets: 2, visible: $('.toggle-col[data-column="2"]').is(':checked') },
            { targets: 3, visible: $('.toggle-col[data-column="3"]').is(':checked') },
            { targets: 4, visible: $('.toggle-col[data-column="4"]').is(':checked') },
            { targets: 5, visible: $('.toggle-col[data-column="5"]').is(':checked') },
            { targets: 6, visible: $('.toggle-col[data-column="6"]').is(':checked') },
            { targets: 7, visible: $('.toggle-col[data-column="7"]').is(':checked') },
            { targets: 8, visible: $('.toggle-col[data-column="8"]').is(':checked') },
            { targets: 9, visible: $('.toggle-col[data-column="9"]').is(':checked') },
            { targets: 10, visible: $('.toggle-col[data-column="10"]').is(':checked')},
            { targets: 11, visible: $('.toggle-col[data-column="11"]').is(':checked')},
        ],

        order: [[0, 'desc']],
    });

    $('.toggle-col').on('change', function () {
        let column = $('#tablaCompras').DataTable().column($(this).data('column'));
        column.visible(this.checked);
    });

});