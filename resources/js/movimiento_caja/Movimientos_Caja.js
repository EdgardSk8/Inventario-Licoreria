$(document).ready(function () {

    let tabla = $('#tablaMovimientosCaja').DataTable({

        processing: true,

        ajax: { 
            url: '/movimientos-caja/mostrar', 
            type: 'GET', 
            dataSrc: 'movimientos' 
        },

        columns: [
            { data: 'nombre_completo_usuario' },

            { 
                data: 'fecha_movimiento_caja',
                render: function(data){
                    return formatearFecha(data);
                }
            },

            // ✅ CAJA POR FECHA (CORREGIDO)
            { 
                data: 'fecha_apertura',
                render: function(data, type, row){
                    return `Caja #${row.id_caja}<br>` /*`<small>${formatearFecha(data)}</small>`*/;
                }
            },

            { 
                data: 'tipo_movimiento_caja',
                render: function(data){
                    if (data === 'INGRESO') {
                        return `<span class="badge bg-success">INGRESO</span>`;
                    } else {
                        return `<span class="badge bg-danger">SALIDA</span>`;
                    }
                }
            },

            { data: 'concepto_movimiento_caja' },

            { 
                data: 'monto_movimiento_caja',
                render: $.fn.dataTable.render.number(',', '.', 2, 'C$ ')
            },

            { 
                data: 'cuenta_destino',
                render: function(data){
                    return data ? data : '—';
                }
            },

            { 
                data: 'id_referencia',
                render: function(data){
                    return data ? data : '—';
                }
            }
        ],

        columnDefs: [
            { targets: 0, visible: $('.toggle-col[data-column="0"]').is(':checked') },
            { targets: 1, visible: $('.toggle-col[data-column="1"]').is(':checked') },
            { targets: 2, visible: $('.toggle-col[data-column="2"]').is(':checked') },
            { targets: 3, visible: $('.toggle-col[data-column="3"]').is(':checked') },
            { targets: 4, visible: $('.toggle-col[data-column="4"]').is(':checked') },
            { targets: 5, visible: $('.toggle-col[data-column="5"]').is(':checked') },
            { targets: 6, visible: $('.toggle-col[data-column="6"]').is(':checked') },
            { targets: 7, visible: $('.toggle-col[data-column="7"]').is(':checked') }
        ],

        order: [[1, 'desc']],

        ...Traduccion

    });


    /* ╔═════ Toggle columnas ═════╗ */
    $('.toggle-col').on('change', function () {
        const column = tabla.column($(this).attr('data-column'));
        column.visible(this.checked);
    });

});