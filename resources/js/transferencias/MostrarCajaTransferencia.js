$(document).ready(function () {

    document.getElementById('titulo').textContent = 'TRANSFERENCIA CAJA → CUENTA';
    

    const tabla = $('#tablaCajaCuenta').DataTable({

        processing: true,
        ajax: {
            url: '/movimientos-caja-cuenta/mostrar',
            type: 'GET',
            dataSrc: 'data',
        },

        columns: [

            // Nº Caja
            {
                data: 'numero_caja',
                render: function (data, type) {

                    if (type === 'sort' || type === 'type') { return data; }

                    return `<span class="fw-bold">Caja #${data}</span>`; 
                }
            },

            // Fecha cierre
            {
                data: 'fecha_cierre',
                render: function(data){
                    return data 
                        ? `<span class="text-secondary">${formatearFechaDia(data)}</span>`
                        : '<span class="estado estado-activo">Abierta</span>';
                }
            },

            // Monto Inicial
            { 
                data: 'monto_inicial',
                render: function(data){
                    return '<span class="text-secondary">C$ ' + parseFloat(data).toFixed(2) + '</span>';
                }
            },

            // Monto Final (BD)
            {
                data: 'monto_final',
                render: function(data, type, row){

                    if (!data) {
                        return '<span class="estado estado-activo">En proceso</span>';
                    }

                    let montoFinal = parseFloat(data);

                    return '<span class="text-secondary">C$ ' + montoFinal.toFixed(2) + '</span>';
}
            },
            // Saldo Caja
            { 
                data: 'saldo_caja',
                render: function(data){
                    return data > 0
                        ? '<span class="text-success fw-bold">C$ ' + parseFloat(data).toFixed(2) + '</span>'
                        : '<span class="text-danger fw-bold">C$ ' + parseFloat(data).toFixed(2) + '</span>';
                }
            },
            { 
                data: 'monto_transferido',
                render: function(data){

                    let monto = parseFloat(data) || 0;

                    if (monto === 0) {
                        return '<span>C$ 0.00</span>';
                    }

                    return '<span class="fw-bold">C$ ' + monto.toFixed(2) + '</span>';
                }
            },

            // Nombre Cuenta (última usada)
            {
                data: 'nombre_cuenta',
                render: function(data){
                    return data 
                        ? `<span class="badge bg-info text-dark">${data}</span>`
                        : '<span class="text-muted">-</span>';
                }
            },

            // Saldo Cuenta
            // { 
            //     data: 'saldo_cuenta',
            //     render: function(data){
            //         return data !== null
            //             ? '<span class="text-success fw-bold">C$ ' + parseFloat(data).toFixed(2) + '</span>'
            //             : '<span class="text-muted">-</span>';
            //     }
            // },

            // Acciones
            {
                data: null,
                render: function(data, type, row){

                    const cajaAbierta = !row.fecha_cierre;
                    const saldoCaja = parseFloat(row.saldo_caja) || 0;

                    const deshabilitarTransferir = cajaAbierta || saldoCaja <= 0;

                    return `
                        <button class="btn btn-sm ${cajaAbierta ? 'btn-danger' : 'btn-success'} btn-transferir"
                            data-id_caja="${row.numero_caja}"
                            ${deshabilitarTransferir ? 'disabled title="' + (cajaAbierta ? 'La caja aún está abierta' : 'Saldo insuficiente') + '"' : ''}>
                            <i class="bi bi-cash-coin"></i> Trasladar
                        </button>

                        <button class="btn btn-sm btn-detalle"
                            data-id_caja="${row.numero_caja}">
                            <i class="bi bi-eye"></i> Detalle
                        </button>
                    `;
                }
            }

        ],

        order: [[0, 'desc']],
        lengthMenu: [15, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        ...Traduccion
    });

});