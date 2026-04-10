$(document).on('click', '.btn-detalle', function () {

    let idVenta = $(this).data('id');

    // Mensaje mientras carga (opcional)
    $('#tablaDetalles').html('<tr><td colspan="5" class="text-center">Cargando...</td></tr>');

    $.get(`/ventas/${idVenta}/detalle`, function(res){

        let venta = res.venta;

        /* ═════════════ INFO GENERAL ═════════════ */

        $('#facturaTitulo').text(`Factura: ${venta.numero_factura}`);
        $('#clienteNombre').text(venta.cliente?.nombre_cliente ?? '—');
        $('#usuarioNombre').text(venta.usuario?.nombre_usuario ?? '—');
        $('#fechaVenta').text(venta.fecha_venta);
        $('#metodoPago').text(venta.metodo_pago?.nombre_metodo_pago ?? '—');

        /* ═════════════ TABLA DETALLES ═════════════ */

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

        /* ═════════════ TOTALES ═════════════ */

        $('#subtotalVenta').text(`C$ ${parseFloat(venta.subtotal_venta).toFixed(2)}`);
        $('#impuestoVenta').text(`C$ ${parseFloat(venta.impuesto_venta).toFixed(2)}`);
        $('#totalVenta').text(`C$ ${parseFloat(venta.total_venta).toFixed(2)}`);

        /* ═════════════ MOSTRAR MODAL ═════════════ */

        $('#modalDetalleVenta').modal('show');

    });

});