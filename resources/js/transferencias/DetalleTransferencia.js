$('#tablaCajaCuenta').on('click', '.btn-detalle', function () {

    const idCaja = $(this).data('id_caja');

    console.log('📦 Caja seleccionada:', idCaja);

    // UI reset
    $('#tablaDetalleTransferencias').html('');
    $('#detalleCantidadTransferencias').text('0');
    $('#detalleTotalTransferido').text('C$ 0.00');
    $('#detalleSaldoTransferencias').text('C$ 0.00');

    // títulos
    $('#cajaDetalleTitulo').text('#' + idCaja);
    $('#detalleCajaNumero').text('#' + idCaja);

    cargarDetalleTransferencias(idCaja);

    const modal = new bootstrap.Modal(
        document.getElementById('modalDetalleTransferencias')
    );

    modal.show();
});


function cargarDetalleTransferencias(idCaja) {

    console.log('📡 Cargando transferencias caja:', idCaja);

    $.ajax({
        url: '/movimientos-caja-cuenta/detalle/' + idCaja,
        type: 'GET',
        dataType: 'json',

        success: function (res) {

            console.log('📦 RESPUESTA:', res);

            if (!res.success) {
                console.log('❌ Backend respondió error');
                return;
            }

            const tbody = $('#tablaDetalleTransferencias');
            tbody.html('');

            // 🟢 RESUMEN (FUERA DE LA TABLA)
            $('#detalleSaldoTransferencias').text(
                'C$ ' + parseFloat(res.saldo_cuenta ?? 0).toFixed(2)
            );

            $('#detalleCantidadTransferencias').text(res.cantidad ?? 0);

            $('#detalleTotalTransferido').text(
                'C$ ' + parseFloat(res.total ?? 0).toFixed(2)
            );

            // 🟢 TABLA
            if (!res.data || res.data.length === 0) {

                tbody.html(`
                    <tr>
                        <td colspan="5" class="text-muted">
                            Sin transferencias registradas
                        </td>
                    </tr>
                `);

            } else {

                res.data.forEach((t, index) => {

                    console.log('➡ Transferencia:', t);

                    tbody.append(`
                        <tr>
                            <td>${index + 1}</td>

                            <td>
                                <span class="fw-semibold">
                                    ${t.usuario}
                                </span>
                            </td>

                            <td class="text-success fw-bold">
                                C$ ${parseFloat(t.monto).toFixed(2)}
                            </td>

                            <td>
                                <span class="text-muted">
                                    ${t.nombre_cuenta}
                                </span>
                            </td>


                            <td>
                                ${formatearFechaDia(t.fecha)}
                            </td>
                        </tr>
                    `);
                });
            }
        },

        error: function (xhr) {

            console.log('❌ ERROR AJAX:', xhr.responseText);
            alert('Error al cargar transferencias');
        }
    });
}