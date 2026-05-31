$(document).ready(function () {

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔹 VARIABLES */
/* ------------------------------------------------------------------------------------------------------------------- */

    let carrito = [];

    let tabla = $('#tabla_carrito').DataTable({
        paging: false,
        searching: false,
        info: false,
        ordering: false,
    });

    document.getElementById('titulo').textContent = 'REGISTRO DE COMPRAS';

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔹 SELECT2 PRODUCTO (SOLO IMPUESTO + NOMBRE) */
/* ------------------------------------------------------------------------------------------------------------------- */

    $('#producto_select').select2({
        ajax: {
            url: '/productos-compra/mostrar',
            dataType: 'json',
            processResults: function (res) {
                return {
                    results: res.data.map(p => ({
                        id: p.id,
                        text: p.text,
                        impuesto: parseFloat(p.impuesto) || 0,
                        precio: parseFloat(p.precio) || 0
                    }))
                };
            }
        }
    });

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔹 SELECT2 PROVEEDOR */
/* ------------------------------------------------------------------------------------------------------------------- */

    $('#proveedor').select2({
        ajax: {
            url: '/proveedores-compra/mostrar',
            dataType: 'json',
            processResults: function (res) {
                return { results: res.data };
            }
        }
    });

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔹 SELECTORES AUXILIARES */
/* ------------------------------------------------------------------------------------------------------------------- */

    function cargarTiposFactura() {
        $.get('/tipo-factura-compra/mostrar', function (res) {
            let html = '<option disabled selected>Seleccione tipo factura</option>';
            res.data.forEach(t => {
                html += `<option value="${t.id_tipo_factura}">${t.nombre_tipo_factura}</option>`;
            });
            $('#tipo_factura').html(html);
        });
    }

    function cargarMetodosPago() {
        $.get('/metodo-pago-compra/mostrar', function (res) {
            let html = '<option disabled selected>Seleccione método</option>';
            res.data.forEach(m => {
                html += `<option value="${m.id_metodo_pago}">${m.nombre_metodo_pago}</option>`;
            });
            $('#metodo_pago').html(html);
        });
    }

        $('#cajacuentaselect').on('change', function() {

        const tipoPago = $(this).val();

        if (tipoPago === 'caja') { // Resetea el selector

            $('#caja_select').prop('disabled', false).val('');
            $('#cuenta').prop('disabled', true).val('');

        } else if (tipoPago === 'cuenta') {

            $('#cuenta').prop('disabled', false).val('');
            $('#caja_select').prop('disabled', true).val('');

        } else { $('#caja_select, #cuenta').prop('disabled', true).val(''); }

    });
    function cargarCuentas() {
        $.get('/cuenta-compra/mostrar', function (res) {
            let select = $('#cuenta');
            select.html('<option value="" disabled selected>Seleccione cuenta</option>');

            if (res.success && Array.isArray(res.cuentas)) {
                res.cuentas.forEach(c => {
                    select.append(`<option value="${c.id}">${c.display}</option>`);
                });
            }
        });
    }

    cargarTiposFactura();
    cargarMetodosPago();
    cargarCuentas();



    $(document).on('producto-creado', function(e, p) {

        carrito.push({
            id: p.id,
            nombre: p.nombre,
            cantidad: p.cantidad || 1,
            precio: p.precio || 0,
            precio_original: p.precio,
            precio_compra: p.precio_compra || 0,
            impuesto: p.impuesto || 0,
            descuento: 0
        });

        renderCarrito();
        recalcularTodo();
    });

/* ------------------------------------------------------------------------------------------------------------------- */


/* ═════════════ ( SELECTOR CAJAS ABIERTAS ) ═══════════════ */

    function cargarCajasAbiertas(total = 0) {

        $.get('/caja-compra/mostrar', function(res) {

            let html = '<option value="" disabled selected>Seleccione caja</option>';

            if (!res.data?.length) {
                html += '<option value="" disabled>No hay cajas abiertas</option>';
                $('#caja_select').html(html).prop('disabled', true);
                return;
            }

            html += res.data.map(c => {
                const saldoSuficiente = c.saldo_actual >= total;
                const style = saldoSuficiente ? 'color: green; font-weight: bold;' : 'color: red;';
                const disabled = saldoSuficiente ? '' : 'disabled';
                const label = saldoSuficiente ? c.text : `${c.text} (Saldo insuficiente)`;
                return `<option value="${c.id}" style="${style}" ${disabled}>${label}</option>`;
            }).join('');

            $('#caja_select').html(html);

        });
    }

/* --------------------------------------------------------------------------------------------- */

/* ═════════════ ( ACTUALIZADOR DE PRECIO CAJA ) ═══════════════ */

    const actualizarCajas = () => cargarCajasAbiertas(parseFloat($('#total').val()) || 0);

    actualizarCajas();

/* 🔥 AGREGAR PRODUCTO (PRECIO SOLO USUARIO) */
/* ------------------------------------------------------------------------------------------------------------------- */

    $('#btnAgregar').click(function () {

        let data = $('#producto_select').select2('data')[0];

        if (!data) return mostrarToast('Seleccione producto', 'danger');

        let cantidad = parseFloat($('#cantidad').val()) || 0;
        let precio = parseFloat($('#precio_usuario').val()) || 0; // 🔥 USER INPUT

        if (cantidad <= 0) return mostrarToast('Cantidad inválida', 'danger');
        //if (precio <= 0) return mostrarToast('Precio inválido', 'danger');

        let existente = carrito.find(p => p.id === data.id);

        if (existente) {

            existente.cantidad += cantidad;
            existente.precio = precio;
            existente.impuesto = data.impuesto;

        } else {

            carrito.push({
                id: data.id,
                nombre: data.text,
                cantidad,
                precio,
                precio_original: data.precio,
                impuesto: data.impuesto,
                descuento: 0
            });
        }

        renderCarrito();
        recalcularTodo();

        $('#producto_select').val(null).trigger('change');
        $('#cantidad').val(1);
        $('#precio_usuario').val('');
    });

    $('#cantidad').val(1);
    $('#descuento').val(0);
    $('#impuesto').val(0);
    $('#subtotal').val(0);
    $('#total').val(0);

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔥 RENDER CARRITO */
/* ------------------------------------------------------------------------------------------------------------------- */

    function renderCarrito() {

        tabla.clear();

        carrito.forEach((p, i) => {
            

            let subtotal = (Number(p.precio) || 0) * (Number(p.cantidad) || 0);
            let impuestoValor = subtotal * ((p.impuesto || 0) / 100);
            let totalItem = subtotal + impuestoValor;

            tabla.row.add([
                i + 1,
                p.nombre,

                `<input type="number"
                    class="cantidad"
                    data-index="${i}"
                    placeholder="0"
                    value="${p.cantidad}">`,

                p.precio_original.toFixed(2),

                `<input type="number"
                    class="precio"
                    data-index="${i}"
                    placeholder="0"
                    value="${p.precio > 0 ? p.precio : ''}">`,

                moneda(subtotal),
                moneda(impuestoValor),
                moneda(totalItem),

                `<button class="btn btn-danger btn-sm eliminar" data-index="${i}">
                    <i class="bi bi-trash"></i>
                </button>`
            ]);
        });

        tabla.draw();
    }

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔥 EVENTOS DINÁMICOS */
/* ------------------------------------------------------------------------------------------------------------------- */

    $('#tabla_carrito').on('blur', '.cantidad, .precio', function () {

        let i = $(this).data('index');
        let valor = parseFloat($(this).val()) || 0;

        if (!carrito[i]) return;

        if ($(this).hasClass('cantidad')) carrito[i].cantidad = valor;
        if ($(this).hasClass('precio')) carrito[i].precio = valor;

        recalcularTodo();
        renderCarrito();
    });

    $('#tabla_carrito').on('click', '.eliminar', function () {
        carrito.splice($(this).data('index'), 1);
        recalcularTodo();
    });

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔥 CÁLCULO GLOBAL REAL */
/* ------------------------------------------------------------------------------------------------------------------- */

    function recalcularTodo() {

        let subtotalGeneral = 0;
        let impuestoGeneral = 0;

        carrito.forEach(p => {

            let subtotal = (p.precio || 0) * (p.cantidad || 0);
            let impuesto = subtotal * ((p.impuesto || 0) / 100);

            subtotalGeneral += subtotal;
            impuestoGeneral += impuesto;
        });

        let descuento = parseFloat($('#descuento').val()) || 0;

        let total = subtotalGeneral + impuestoGeneral - descuento;

        $('#subtotal').val(subtotalGeneral.toFixed(2));
        $('#impuesto').val(impuestoGeneral.toFixed(2));
        $('#total').val(total.toFixed(2));

        //actualizarCajas();
    }

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔥 CAJAS */
/* ------------------------------------------------------------------------------------------------------------------- */

    // function cargarCajasAbiertas(total = 0) {

    //     $.get('/caja-compra/mostrar', function (res) {

    //         let html = '<option disabled selected>Seleccione caja</option>';

    //         if (!res.data?.length) {
    //             $('#caja_select').html('<option>No hay cajas</option>');
    //             return;
    //         }

    //         html += res.data.map(c => {

    //             let ok = c.saldo_actual >= total;

    //             return `<option value="${c.id}" ${ok ? '' : 'disabled'}>
    //                 ${c.text} ${ok ? '' : '(Saldo insuficiente)'}
    //             </option>`;
    //         }).join('');

    //         $('#caja_select').html(html);
    //     });
    // }

    // function actualizarCajas() {
    //     cargarCajasAbiertas(parseFloat($('#total').val()) || 0);
    // }

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔥 LIMPIAR */
/* ------------------------------------------------------------------------------------------------------------------- */

    $('#btnLimpiar').click(function () {

        carrito = [];
        renderCarrito();

        $('#proveedor, #tipo_factura, #metodo_pago, #cuenta').val(null).trigger('change');

        $('#numero_factura, #subtotal, #total, #impuesto').val('');
        $('#descuento').val(0);
    });

/* ------------------------------------------------------------------------------------------------------------------- */
/* 🔥 REGISTRAR */
/* ------------------------------------------------------------------------------------------------------------------- */

    $('#btnRegistrar').click(function () {

        let data = {
            numero_factura: $('#numero_factura').val(),
            proveedor: $('#proveedor').val(),
            tipo_factura: $('#tipo_factura').val(),
            metodo_pago: $('#metodo_pago').val(),
            caja: $('#caja_select').val(),
            cuenta: $('#cuenta').val(),
            descuento: parseFloat($('#descuento').val()) || 0,
            impuesto: parseFloat($('#impuesto').val()) || 0,
            carrito
        };

        if (!data.proveedor) return mostrarToast('Seleccione proveedor', 'danger');
        if (carrito.length === 0) return mostrarToast('Agregue productos', 'danger');

            if (!data.caja && !data.cuenta) {
            return mostrarToast('Seleccione caja o cuenta', 'danger');
        }

        $.ajax({
            url: '/compra/crear',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (res) {
                if (res.success) {
                    mostrarToast('Compra registrada correctamente', 'success');
                    $('#btnLimpiar').click();
                } else {
                    mostrarToast('Error desconocido', 'danger');
                }
            },

            error: function () {
                mostrarToast('Error al registrar compra', 'danger');
            }
        });

    });

/* ------------------------------------------------------------------------------------------------------------------- */

});