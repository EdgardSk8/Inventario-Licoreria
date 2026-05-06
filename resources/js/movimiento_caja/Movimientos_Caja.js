$(document).ready(function () {

    document.getElementById('titulo').textContent = 'MOVIMIENTOS DE CAJA';

    let tabla = $('#tablaMovimientosCaja').DataTable({

        processing: true,

        ajax: { 
            url: '/movimientos-caja/mostrar', 
            type: 'GET', 
            dataSrc: 'movimientos' 
        },

        columns: [

            { data: 'id_movimiento_caja', visible: false },
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
                    return `<strong>Caja #${row.id_caja}<br>` /*`<small>${formatearFecha(data)}</small>`*/;
                }
            },

            { 
                data: 'tipo_movimiento_caja',
                render: function(data){
                    if (data === 'INGRESO') {
                        return `<strong class="text-success">INGRESO</strong>`;
                    } else {
                        return `<strong class="text-danger">SALIDA</strong>`;
                    }
                }
            },
            {
                data: 'monto_movimiento_caja',
                render: function(data, type, row) {

                    let monto = parseFloat(data).toFixed(2);

                    if (row.tipo_movimiento_caja === 'INGRESO') {
                        return `<strong class="text-success">+ C$ ${monto}</strong>`;
                    } else {
                        return `<strong class="text-danger">- C$ ${monto}</strong>`;
                    }
                }
            },

            { data: 'concepto_movimiento_caja' },

            { 
                data: 'cuenta_destino',
                render: function(data){
                    return data ? data : '—';
                }
            },

            // { 
            //     data: 'id_referencia',
            //     render: function(data){
            //         return data ? data : '—';
            //     }
            // }
        ],

        order: [[0, 'desc']],

        lengthMenu: [10, 14, 20, 30, 40, 50, 60, 70, 80, 90, 100],

        ...Traduccion

    });


    /* ╔═════ Toggle columnas ═════╗ */
    $('.toggle-col').on('change', function () {
        const column = tabla.column($(this).attr('data-column'));
        column.visible(this.checked);
    });

});