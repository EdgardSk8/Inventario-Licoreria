$(document).ready(function () {

    document.getElementById('titulo').textContent = 'CONTROL DE CAJAS';

    const tabla = $('#tablaCajas').DataTable({

        processing: true,
        ajax: { url: '/cajas/registro',type: 'GET',dataSrc: 'data', },

        columns: [
            { data: 'id_caja',
                render: function (data, type) {
                    if (type === 'sort' || type === 'type') return data; return `<strong>Caja #${data}</strong>`;
                }
            },
            { data: 'usuario.nombre_usuario'},
            { data: 'fecha_apertura', render: function(data){ return formatearFechaDiaHora(data); } },
            { data: 'fecha_cierre', render: function(data){
                return data ? formatearFechaDiaHora(data) : '<span class="estado estado-activo">Caja abierta</span>'; } },
            { data: 'monto_inicial', render: function(data){ return '<strong>' + ' C$ ' + parseFloat(data).toFixed(2); } },
            { data: 'monto_final',render: function(data){ return data 
                    ? '<strong class="text-success">' + 'C$ ' + parseFloat(data).toFixed(2) : '<span class="estado estado-activo">En proceso</span>'; } },
            { data: 'estado_caja',render: function(data){return data == 1
                    ? '<span class="estado estado-activo">Abierta</span>' : '<span class="estado estado-inactivo">Cerrada</span>';} }
        ],
        order: [[0, 'desc']], //Orden por id
        lengthMenu: [15, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        ...Traduccion // Constante de traduccion de datatables
    });

});
