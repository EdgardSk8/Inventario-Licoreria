$(document).ready(function () {

    $('#tablaKardex').DataTable({

        processing: true,

        ajax: { 
            url: '/movimiento-inventario/mostrar', 
            type: 'GET', 
            dataSrc: 'movimientos' 
        },

        columns: [
            { data: 'nombre_completo_usuario' },
            { data: 'fecha_movimiento', render: function(data){ return formatearFecha(data); } },
            { data: 'nombre_producto' },
            { data: 'tipo_movimiento',
                render: function(data) {
                    if (data === 'ENTRADA') { return `<strong class="text-success">${data}</strong>`; } 
                    else if (data === 'SALIDA') { return `<strong class="text-danger">${data}</strong>`; }
                    return data;
                }
            },
            { data: 'tipo_referencia' },        // Columna separada: Tipo de referencia         // Columna separada: ID de referencia
            { data: 'motivo_movimiento' }, 
            { data: 'cantidad_movimiento' },
            { data: 'stock_resultante' },

            
            { data: 'precio_unitario', render: $.fn.dataTable.render.number(',', '.', 2, 'C$') },
            { data: null, render: function(data){
                return (data.precio_unitario * data.cantidad_movimiento).toFixed(2);
            }}
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

        order: [[1, 'desc']],

        ...Traduccion // Tu constante de traducción de DataTables

    }); // Fin de DataTables

    $('.toggle-col').on('change', function(e) {
    const column = $('#tablaKardex').DataTable().column($(this).attr('data-column'));
    column.visible(this.checked);
});

});