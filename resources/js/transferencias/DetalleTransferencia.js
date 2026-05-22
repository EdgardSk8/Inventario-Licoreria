$('#tablaCajaCuenta').on('click', '.btn-detalle', function () {

    const idCaja = $(this).data('id_caja');

    // UI reset
    $('#tablaDetalleTransferencias').html('');
    $('#detalleCantidadTransferencias').text('0');
    $('#detalleTotalTransferido').text('C$ 0.00');

    // títulos
    $('#cajaDetalleTitulo').text('#' + idCaja);
    $('#detalleCajaNumero').text('#' + idCaja);

    cargarDetalleTransferencias(idCaja);

    const modal = new bootstrap.Modal( document.getElementById('modalDetalleTransferencias') );
    modal.show();

});


function cargarDetalleTransferencias(idCaja) {

    $.ajax({
        url: '/movimientos-caja-cuenta/detalle/' + idCaja,
        type: 'GET',
        dataType: 'json',

        success: function (res) {

            if (!res.success) {
                return;
            }

            const tbody = $('#tablaDetalleTransferencias');
            tbody.html('');

            $('#detalleCantidadTransferencias').text(res.cantidad ?? 0);
            $('#detalleTotalTransferido').text( moneda(res.total) );

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

                    tbody.append(`
                        <tr>
                            <td>${index + 1}</td>

                            <td>
                                <span class="fw-semibold">
                                    ${t.usuario}
                                </span>
                            </td>

                            <td class="text-success fw-bold">
                                ${moneda(t.monto)}
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