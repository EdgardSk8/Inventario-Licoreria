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
            { data: 'numero_caja' },

            // Fecha cierre
            {
                data: 'fecha_cierre',
                render: function(data){
                    return data 
                        ? `<span>${formatearFechaDia(data)}</span>`
                        : '<span class="estado estado-activo">Abierta</span>';
                }
            },

            // Monto Inicial
            { data: 'monto_inicial', render: data => moneda(data) },

            // Monto Final (BD)
            {
                data: 'monto_final',
                render: function(data, type, row) {
                    if (!data) { return '<span class="estado estado-activo">En proceso</span>'; }
                    return moneda(data);
                }
            },
            // Saldo Caja
            { 
                data: 'saldo_caja',
                render: function(data){

                    const valor = parseFloat(data || 0);

                    return valor > 0
                        ? '<span class="text-success fw-bold">' + moneda(valor) + '</span>'
                        : '<span class="text-danger fw-bold">' + moneda(valor) + '</span>';
                }
            },
            { 
                data: 'monto_transferido',
                render: function(data){

                    let monto = parseFloat(data) || 0;

                    if (monto === 0) {
                        return '<span>' + moneda(0) + '</span>';
                    }

                    return '<span class="fw-bold">' + moneda(monto) + '</span>';
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
    });

});