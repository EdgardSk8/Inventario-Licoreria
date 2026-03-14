$(document).ready(function () {

    const tabla = $('#tablaCajas').DataTable({
        processing: true,
        ajax: {
            url: '/cajas/registro',
            type: 'GET',
            dataSrc: 'data',
            order: [[0, "desc"]],
        },
        columns: [
            { 
                data: 'usuario.nombre_usuario'
            },

            { data: 'fecha_apertura', render: function(data){
                return formatearFecha(data);
                } 
            },

            { 
                data: 'fecha_cierre',
                render: function(data){
                    return data ? formatearFecha(data) : '<span class="estado estado-activo">Caja abierta</span>';
                }
            },

            { 
                data: 'monto_inicial',
                render: function(data){
                    return 'C$ ' + parseFloat(data).toFixed(2);
                }
            },

            { 
                data: 'monto_final',
                render: function(data){
                    return data 
                        ? 'C$ ' + parseFloat(data).toFixed(2)
                        : '<span class="estado estado-activo">En proceso</span>';
                }
            },

            { 
                data: 'estado_caja',
                render: function(data){
                    return data == 1
                        ? '<span class="estado estado-activo">Abierta</span>'
                        : '<span class="estado estado-inactivo">Cerrada</span>';
                }
            }
        ],

        order: [[0, "desc"]],

        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "No hay datos disponibles",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            }
        }
    });

});
