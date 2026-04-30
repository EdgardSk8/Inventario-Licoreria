$(document).ready(function () {

    document.getElementById('titulo').textContent = 'HISTORIAL DE GASTOS';

    let tabla = $('#tablaMovimientosGastos').DataTable({

        responsive: true,
        processing: true,

        ajax: { 
            url: '/movimientos-gastos/mostrar', 
            type: 'GET', 
            dataSrc: 'movimientos' 
        },

        columns: [

            { 
                data: 'fecha', 
                render: function(data){
                    return formatearFecha(data);
                } 
            },

            { data: 'gasto.nombre' },

            { 
                data: 'monto',
                render: function(data){
                    return '<strong class="text-danger">C$ ' + parseFloat(data).toFixed(2);
                }
            },

            { 
                data: 'origen',
                render: function(data){
                    return data === 'CAJA'
                        ? '<strong class="text-primary">CAJA</span>'
                        : '<strong class="text-secondary">CUENTA</span>';
                }
            },

            { 
                data: 'caja',
                render: function(data){
                    return data ? '<strong>Caja #' + data.id : '—';
                }
            },

            { 
                data: 'cuenta',
                render: function(data){
                    return data ? '<strong>' + data.nombre : '—';
                }
            },

            { data: 'usuario.nombre' },

            { 
                data: 'observacion',
                render: function(data){
                    return data ?? '—';
                }
            }
        ],

       

        lengthMenu: [15, 20, 30, 40, 50, 60, 70, 80, 90, 100],

        order: [[0, 'desc']],

        ...Traduccion
    });

});