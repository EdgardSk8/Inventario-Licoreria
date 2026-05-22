$(document).ready(function () {

    let carrito = [];
    let imprimirFacturaActivo = false;
    let imprimirProformaActivo = false;
    document.getElementById('titulo').textContent = 'SISTEMA DE FACTURACION';

    const tablaProductos = inicializarTablaProductos();
    eventosProductos(tablaProductos);

/*-------------------------------------------------------------------------------------------------------------------*/

/* ════════════════════════════ FUNCIONES ════════════════════════════ */
    
    function eventosProductos() {

        $('#tablaProductos').on('click', '.agregarProducto', function () {

            const producto = {
                id: $(this).data('id'),
                nombre: $(this).data('nombre'),
                precio: parseFloat($(this).data('precio')),
                stock: parseInt($(this).data('stock')),
                 porcentaje_impuesto: parseFloat($(this).data('porcentaje')) || 0
            }; agregarProductoCarrito(producto);

        });
    }

    /* --- AGREGAR PRODUCTOS AL CARRITO --- */
    function agregarProductoCarrito(producto) {

        let existente = carrito.find(p => p.id === producto.id);
        if (existente) {
            if (existente.cantidad >= existente.stock) { mostrarToast(`No hay más stock de ${existente.nombre}`, 'danger'); return; }
            existente.cantidad++;
        } else { carrito.push({ ...producto, cantidad: 1 }); }
        RenderizarCarrito();

    }

    /* --- RENDERIZAR TABLA CARRITO --- */
    function RenderizarCarrito() {

        let html = '';
        let total = 0;

        carrito.forEach((p, i) => {

            let subtotal = p.precio * p.cantidad;
            total += subtotal;

            html += `
                <tr>
                    <td>${p.nombre}</td>
                    <td class="col-cantidad">
                        <input type="number" value="${p.cantidad}" min="1"
                            class="cantidad"
                            data-index="${i}">
                    </td>
                    <td>C$ ${p.precio.toFixed(2)}</td>
                    <td>C$ ${subtotal.toFixed(2)}</td>
                    <td>
                        <button class="eliminar" data-index="${i}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        $('#carrito').html(html);
        $('#total').text('C$ ' + total.toFixed(2));
        calcularVueltos();
    }

    /* --- FORMATO DE MONEDA --- */
    function moneda(valor, decimales = 2) {
        const numero = parseFloat(valor || 0);
        const numeroFormateado = numero.toLocaleString('en-US', {
            minimumFractionDigits: decimales, maximumFractionDigits: decimales
        });
        return 'C$ ' + numeroFormateado;
    }

    /* --- VALIDAR FACTURACION --- */
    function validarFactura(cliente, total, recibido, metodo) {

        if (carrito.length === 0) { mostrarToast('Agregue productos', 'danger'); return false; }
        if (!cliente) { mostrarToast('Seleccione cliente', 'danger'); return false; }
        if ( !imprimirProformaActivo && metodo == 1 && recibido < total) { mostrarToast('Pago insuficiente', 'danger'); return false; }
        for (let p of carrito) { if (p.cantidad > p.stock) { mostrarToast(`Stock insuficiente para ${p.nombre}`, 'danger'); return false; } }
        return true;

    }

    /* --- VALIDACION DE STOCK --- */
    async function validarStockBD() {

        let res = await fetch('/validar-stock-carrito', { method: 'POST', 
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            body: JSON.stringify({ carrito })
        });

        let data = await res.json();

        if (!data.ok) { mostrarToast(data.mensaje, 'danger');
            let p = carrito.find(x => x.id == data.id);
            if (p) p.stock = data.stock; return false;
        }
        return true;
    }


/*-------------------------------------------------------------------------------------------------------------------*/

/* ════════════════════ INICIALIZACION ══════════════════════ */

    function inicializarTablaProductos() {

        return $('#tablaProductos').DataTable({

            ajax: { url: '/productos/pos', type: 'GET', dataSrc: 'data' },

            columns: [

                { data: 'nombre_producto' },
                { data: 'precio_con_iva', render: function (data) { return moneda(data, 1); } },
                { data: 'stock_actual' },
                { data: 'id_producto',
                    render: function (data, type, row) {

                        let deshabilitado = row.stock_actual <= 0 ? 'disabled' : '';
                        let clase = row.stock_actual <= 0 ? 'btn-secondary' : 'btn-dark';

                        return `
                            <button class="${clase} agregarProducto"
                                data-id="${row.id_producto}"
                                data-nombre="${row.nombre_producto}"
                                data-precio="${row.precio_con_iva}"
                                data-stock="${row.stock_actual}"
                                data-porcentaje="${row.iva}"
                                ${deshabilitado}>
                                <i class="bi bi-cart-plus"></i>
                                Agregar
                            </button>
                        `;
                    }
                },
            ],
        });
    }

/*-------------------------------------------------------------------------------------------------------------------*/

/* ════════════════════ EVENTOS ══════════════════════ */

    $('#toggleFactura').on('change', function () {

        imprimirFacturaActivo = $(this).is(':checked');

        if ($(this).is(':checked')) {
            $('#toggleProformaFactura').prop('checked', false);
            imprimirProformaActivo = false;
            let metodo = parseInt($('#metodo_pago').val()) || 0;
            if (metodo === 1) {
                $('#pagoCordobas').prop('disabled', false);
                $('#pagoDolares').prop('disabled', false);
                $('#vueltoCordobas').prop('disabled', false);
                $('#vueltoDolares').prop('disabled', false);
                $('#btnFacturar').css('background', '#198754');
                $('#btnFacturar').text('Facturar');
            }
            calcularVueltos();
        }

    });

    $('#toggleProformaFactura').on('change', function () {

    imprimirProformaActivo = $(this).is(':checked');

    if (imprimirProformaActivo) {

        $('#toggleFactura').prop('checked', false);
        imprimirFacturaActivo = false;
        $('#pagoCordobas, #pagoDolares, #vueltoCordobas, #vueltoDolares').prop('disabled', true);
        $('#btnFacturar').css({ background: '#0d6efd', border: '1px solid #0d6efd' }).text('Imprimir Proforma');

    } else {

        let metodo = parseInt($('#metodo_pago').val()) || 0;

        $('#btnFacturar').css({ background: '#198754', border: '1px solid #198754' }).text('Facturar');
        $('#vueltoCordobas, #vueltoDolares').prop('disabled', false);
        if (metodo === 1) { $('#pagoCordobas, #pagoDolares').prop('disabled', false); }

    }

    });

    $('#btnLimpiarCaja').on('click', function () {

        carrito = [];
        RenderizarCarrito();

        $('#pagoCordobas').val('');
        $('#pagoDolares').val('');
        $('#vueltoCordobas').val('');
        $('#vueltoDolares').val('');

        $('#clientes').val('1').trigger('change');
        $('#metodo_pago').val('1').trigger('change');

        imprimirFacturaActivo = false;
        imprimirProformaActivo = false;

        $('#toggleFactura').prop('checked', false);
        $('#toggleProformaFactura').prop('checked', false);

        mostrarToast('Limpieza realizada con éxito', 'success');
    });


    $('#metodo_pago').val(null).trigger('change');

    $('#carrito').on('click', '.eliminar', function () { carrito.splice($(this).data('index'), 1); RenderizarCarrito(); });

    $('#carrito').on('keydown', '.cantidad', function (e) { if (e.key === 'Enter') $(this).blur(); });

    $('#carrito').on('blur', '.cantidad', function () {

        let i = $(this).data('index');
        let valor = parseInt($(this).val());

        if (isNaN(valor) || valor < 1) valor = 1;

        carrito[i].cantidad = valor;
        RenderizarCarrito();

    });

    $('#metodo_pago').on('change', function () {

        let metodo = parseInt($(this).val()) || 0;
        if (window.setMetodoPago) window.setMetodoPago(metodo);
        if (metodo === 1) {$('#pagoCordobas, #pagoDolares, #vueltoCordobas, #vueltoDolares').prop('disabled', false);
        } else {$('#pagoCordobas, #pagoDolares, #vueltoCordobas, #vueltoDolares').prop('disabled', true).val(''); }

    });

    $(document).on('keydown', '#pagoCordobas, #pagoDolares', function (e) {
        if (document.activeElement !== this) return;
        if (e.key === 'Enter') { e.preventDefault(); $('#btnFacturar').trigger('click'); }
    });

    $('#btnFacturar').click(async function () {

        $('#btnFacturar').prop('disabled', true);

        let cliente = $('#clientes').val();
        let total = parseFloat($('#total').text().replace(/[^\d.-]/g, '')) || 0;
        let metodo = parseInt($('#metodo_pago').val());

        let recibido = (metodo === 1) ? parseFloat($('#pagoCordobas').val()) || 0 : total;

        if (!validarFactura(cliente, total, recibido, metodo)) { $('#btnFacturar').prop('disabled', false); return; }

        if (imprimirProformaActivo) {

            imprimirProforma({
                cliente: $('#clientes option:selected').text(),
                carrito: carrito,
                total: total
            });

            $('#btnFacturar').prop('disabled', false);
            return;
        }

        let stockOk = await validarStockBD();

        if (!stockOk) { $('#btnFacturar').prop('disabled', false); return; }

        let data = { cliente: cliente, carrito: carrito, total: total, recibido: recibido };

        $.ajax({

            url: '/facturar/pos', method: 'POST', contentType: 'application/json', data: JSON.stringify(data),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (res) {

                if (res.success) {
                    mostrarToast('Factura realizada', 'success');
                    if (imprimirFacturaActivo) { imprimirFactura(res); }

                    carrito = [];
                    RenderizarCarrito();

                    $('#pagoCordobas').val('');
                    $('#pagoDolares').val('');
                    $('#vueltoCordobas').val('');
                    $('#vueltoDolares').val('');

                    $('#metodo_pago').val('1').trigger('change');
                    $('#clientes').val('1').trigger('change');
                    tablaProductos.ajax.reload(null, false);
                }
                $('#btnFacturar').prop('disabled', false);

            }, error: function () { mostrarToast('Error al facturar', 'danger'); $('#btnFacturar').prop('disabled', false); }

        });

    });

/*-------------------------------------------------------------------------------------------------------------------*/

});