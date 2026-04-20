    $(document).on('click', '.btn-detalle', function () {

        let idVenta = $(this).data('id');

        $('#tablaDetalles').html('<tr><td colspan="5" class="text-center">Cargando...</td></tr>');

        $.get(`/ventas/${idVenta}/detalle`, function(res){

            let venta = res.venta;

            // 🔥 Configurar botón anular
            const btn = $('#btnAnular');

            btn.data('id', venta.id_venta);

            if (venta.estado_venta == 0) {
                btn.prop('disabled', true).text('Factura Anulada');
            } else {
                btn.prop('disabled', false).text('Anular Factura');
            }

            /* INFO GENERAL */
            $('#facturaTitulo').text(`Factura: ${venta.numero_factura}`);
            $('#clienteNombre').text(venta.cliente?.nombre_cliente ?? '—');
            $('#usuarioNombre').text(venta.usuario?.nombre_usuario ?? '—');
            $('#fechaVenta').text(venta.fecha_venta);
            $('#metodoPago').text(venta.metodo_pago?.nombre_metodo_pago ?? '—');

            /* DETALLES */
            let filas = '';

            venta.detalles.forEach(detalle => {
                filas += `
                    <tr>
                        <td>${detalle.producto?.nombre_producto ?? '—'}</td>
                        <td class="text-center">${detalle.cantidad_venta}</td>
                        <td class="text-end">C$ ${parseFloat(detalle.precio_unitario_venta).toFixed(2)}</td>
                        <td class="text-end">C$ ${parseFloat(detalle.monto_impuesto).toFixed(2)}</td>
                        <td class="text-end">C$ ${parseFloat(detalle.subtotal_detalle_venta).toFixed(2)}</td>
                    </tr>
                `;
            });

            $('#tablaDetalles').html(filas);

            /* TOTALES */
            $('#subtotalVenta').text(`C$ ${parseFloat(venta.subtotal_venta).toFixed(2)}`);
            $('#impuestoVenta').text(`C$ ${parseFloat(venta.impuesto_venta).toFixed(2)}`);
            $('#totalVenta').text(`C$ ${parseFloat(venta.total_venta).toFixed(2)}`);

            $('#modalDetalleVenta').modal('show');
        });

    });



window.modalAnularVenta = modalAnularVenta = null;

// 🧠 Crear modal solo una vez
function crearModalAnularVenta() {

    const modalHTML = `
    <div class="modal fade" id="modalAnularVenta" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirmar anulación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    ¿Seguro que deseas anular esta factura?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button class="btn btn-danger" id="btnConfirmarAnulacion">
                        Anular
                    </button>
                </div>

            </div>
        </div>
    </div>`;

    document.body.insertAdjacentHTML("beforeend", modalHTML);

    modalAnularVenta = document.getElementById("modalAnularVenta");

    // 🔒 evitar múltiples bindings
    $(document).on('click', '#btnConfirmarAnulacion', function () {

        const btnConfirm = $(this);
        const idVenta = parseInt($('#modalAnularVenta').data('id-venta'));

        if (!idVenta) {
            mostrarToast('ID de venta no válido', 'error');
            return;
        }

        if (btnConfirm.data('loading')) return;
        btnConfirm.data('loading', true);

        const textoOriginal = btnConfirm.text();

        btnConfirm.prop('disabled', true).text('Anulando...');

        $.ajax({
            url: `/ventas/anular/${idVenta}`,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {

                if (res.success) {

                    mostrarToast(res.mensaje, 'success');

                    $('#modalAnularVenta').modal('hide');

                    $('#modalDetalleVenta').modal('hide');

                    $('#tablaVentas').DataTable().ajax.reload(null, false);

                } else {
                    mostrarToast(res.mensaje, 'error');
                }
            },
            error: function (xhr) {

                let msg = 'Error al anular la venta';

                if (xhr.responseJSON?.mensaje) {
                    msg = xhr.responseJSON.mensaje;
                }

                mostrarToast(msg, 'error');
            },
            complete: function () {
                btnConfirm.prop('disabled', false).text(textoOriginal);
                btnConfirm.data('loading', false);
            }
        });
    });
}


// 🚀 Click en botón anular
    window.volverADetalle = volverADetalle = false;

    $(document).on('click', '#btnAnular', function () {

        const btn = $(this);
        let idVenta = parseInt(btn.data('id'));

        if (!idVenta) {
            mostrarToast('No se encontró el ID de la venta', 'error');
            return;
        }

        // 🔒 evitar doble click real
        if (btn.data('loading')) return;
        btn.data('loading', true);

        const detalleModalEl = document.getElementById('modalDetalleVenta');
        const detalleModalInstance = bootstrap.Modal.getInstance(detalleModalEl);

        // 🧠 detectar si venimos del modal de detalle
        volverADetalle = $('#modalDetalleVenta').hasClass('show');

        // guardar id en modal
        $('#modalAnularVenta').data('id-venta', idVenta);

        // cerrar modal detalle si está abierto
        if (detalleModalInstance) {
            detalleModalInstance.hide();
        }

        // abrir confirmación cuando ya cerró el otro modal
        setTimeout(() => {

            if (!modalAnularVenta) {
                crearModalAnularVenta();
            }

            const modal = new bootstrap.Modal(
                document.getElementById('modalAnularVenta')
            );

            modal.show();

            btn.data('loading', false);

        }, 250);
    });

    $(document).on('click', '#modalAnularVenta .btn-secondary', function () {

    const modal = bootstrap.Modal.getInstance(
        document.getElementById('modalAnularVenta')
    );

    modal.hide();

    // 🔁 volver al modal de detalle si venía de ahí
    if (volverADetalle) {

        setTimeout(() => {
            const detalle = new bootstrap.Modal(
                document.getElementById('modalDetalleVenta')
            );
            detalle.show();
        }, 250);
    }
});



