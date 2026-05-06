$(document).ready(function () {

    document.getElementById('titulo').textContent = 'MOVIMIENTOS DE CUENTA';

    let tabla = $('#tablaMovimientosCuenta').DataTable({

        processing: true,

        ajax: { 
            url: '/movimientos-cuenta/mostrar', 
            type: 'GET', 
            dataSrc: 'movimientos' 
        },

        columns: [
            { data: 'id_movimiento_cuenta', visible: false },
            { data: 'nombre_completo_usuario' },

            { 
                data: 'fecha',
                render: function(data){
                    return formatearFecha(data);
                }
            },

            // ✅ CUENTA
            { 
                data: 'nombre_cuenta',
                render: function(data, type, row){
                    return `${data}`;
                }
            },

            { 
                data: 'tipo_movimiento',
                render: function(data){
                    if (data === 'INGRESO') {
                        return `<strong class="text-success">INGRESO</strong>`;
                    } else {
                        return `<strong class="text-danger">SALIDA</strong>`;
                    }
                }
            },

            { 
                data: 'descripcion',
                render: function(data){
                    return data ? data : '—';
                }
            },

            { 
                data: 'monto',
                render: function(data, type, row) {

                    let monto = parseFloat(data).toLocaleString('es-NI', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    if (row.tipo_movimiento === 'INGRESO') {
                        return `<strong class="text-success"> C$ ${monto}</strong>`;
                    } else {
                        return `<strong class="text-danger"> C$ ${monto}</strong>`;
                    }
                }
            },
            

        ],

        order: [[0, 'desc']],

        lengthMenu: [15, 20, 30, 40, 50, 60, 70, 80, 90, 100],

        ...Traduccion

    });


    /* ╔═════ Toggle columnas ═════╗ */
    $('.toggle-col').on('change', function () {
        const column = tabla.column($(this).attr('data-column'));
        column.visible(this.checked);
    });

});