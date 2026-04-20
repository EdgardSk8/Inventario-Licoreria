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

$(document).on('click', '#btnAnular', function () {

    const btn = $(this);
    let idVenta = parseInt(btn.data('id'));

    if (!idVenta) {
        alert('No se encontró el ID de la venta');
        return;
    }

    // 🔒 evitar doble click
    if (btn.data('loading')) return;
    btn.data('loading', true);

    if (!confirm('¿Seguro que deseas anular esta factura?')) {
        btn.data('loading', false);
        return;
    }

    const textoOriginal = btn.text();

    btn.prop('disabled', true).text('Anulando...');

    $.ajax({
        url: `/ventas/anular/${idVenta}`,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {

            if (res.success) {

                alert(res.mensaje);

                $('#modalDetalleVenta').modal('hide');

                // 🔄 recargar tabla sin recargar página
                $('#tablaVentas').DataTable().ajax.reload(null, false);

            } else {
                alert(res.mensaje);
            }
        },
        error: function (xhr) {

            let msg = 'Error al anular la venta';

            if (xhr.responseJSON?.mensaje) {
                msg = xhr.responseJSON.mensaje;
            }

            alert(msg);
        },
        complete: function () {
            btn.prop('disabled', false).text(textoOriginal);
            btn.data('loading', false);
        }
    });

});