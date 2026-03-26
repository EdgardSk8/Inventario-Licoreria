$(document).ready(function () {

/*═══════════════════════════════════════════════════*/
/* 🔹 VARIABLES */

    let carrito = [];

    let tabla = $('#tabla_carrito').DataTable({
        paging: false,
        searching: false,
        info: false,
        ordering: false
    });

/*═══════════════════════════════════════════════════*/
/* 🔹 SELECT2 GENERALES */

    // 🧑 PROVEEDOR
    $('#proveedor').select2({
        ajax: {
            url: '/proveedores-compra/mostrar',
            dataType: 'json',
            processResults: function (res) {
                return {
                    results: res.data
                };
            }
        }
    });

    function cargarTiposFactura() {

        $.get('/tipo-factura-compra/mostrar', function(res){

            let html = '<option value="" disabled selected>Seleccione tipo factura</option>';

            res.data.forEach(t => {
                html += `<option value="${t.id_tipo_factura}">${t.nombre_tipo_factura}</option>`;
            });

            $('#tipo_factura').html(html);
        });
    }

    // ejecutar
    cargarTiposFactura();

/* --------------------------------------------------------------------------------------------- */

    function cargarMetodosPago() {

        $.get('/metodo-pago-compra/mostrar', function(res){

            let html = '<option value="" disabled selected>Seleccione método</option>';

            res.data.forEach(m => {
                html += `<option value="${m.id_metodo_pago}">${m.nombre_metodo_pago}</option>`;
            });

            $('#metodo_pago').html(html);
        });
    }

    // ejecutar
    cargarMetodosPago();


/* --------------------------------------------------------------------------------------------- */

// 🔄 Controlar habilitación según tipo de pago
$('#cajacuentaselect').on('change', function() {
    const tipoPago = $(this).val();
    $('#caja_select').prop('disabled', tipoPago !== 'caja');
    $('#cuenta').prop('disabled', tipoPago !== 'cuenta');
});

/* --------------------------------------------------------------------------------------------- */

// 🏦 Cargar cajas abiertas
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

// Ejecutar al iniciar y al cambiar total, descuento o impuesto
const actualizarCajas = () => cargarCajasAbiertas(parseFloat($('#total').val()) || 0);
actualizarCajas();
$('#total, #descuento, #impuesto').on('input', actualizarCajas);

/* --------------------------------------------------------------------------------------------- */

// 🏦 Cargar cuentas
function cargarCuentas() {
    $.get('/cuenta-compra/mostrar', function(res) {
        const html = ['<option value="" disabled selected>Seleccione cuenta</option>']
            .concat(res.data.map(c => 
                `<option value="${c.id_cuenta}">${c.nombre_cuenta} (C$ ${parseFloat(c.saldo_actual).toFixed(2)})</option>`
            )).join('');
        $('#cuenta').html(html);
    });
}

// Ejecutar
cargarCuentas();

/* --------------------------------------------------------------------------------------------- */


/*═══════════════════════════════════════════════════*/
/* 🔍 PRODUCTOS */

    $('#producto_select').select2({
        placeholder: 'Buscar producto...',
        ajax: {
            url: '/productos/select2',
            dataType: 'json',
            processResults: data => ({
                results: data.map(p => ({
                    id: p.id_producto,
                    text: p.nombre_producto,
                    precio: p.precio_compra
                }))
            })
        }
    });

/*═══════════════════════════════════════════════════*/
/* ➕ AGREGAR PRODUCTO */

    $('#btnAgregar').click(function () {

        let data = $('#producto_select').select2('data')[0];
        let cantidad = parseInt($('#cantidad').val());

        if (!data) return alert('Seleccione producto');
        if (cantidad <= 0) return alert('Cantidad inválida');

        let existente = carrito.find(p => p.id === data.id);

        if (existente) {
            existente.cantidad += cantidad;
        } else {
            carrito.push({
                id: data.id,
                nombre: data.text,
                precio: parseFloat(data.precio),
                cantidad: cantidad,
                descuento: 0,
                impuesto: 0
            });
        }

        renderCarrito();

        $('#producto_select').val(null).trigger('change');
        $('#cantidad').val(1);
    });

/*═══════════════════════════════════════════════════*/
/* 🎨 RENDER CARRITO */

    function renderCarrito() {

        tabla.clear();

        let subtotalGeneral = 0;

        carrito.forEach((p, i) => {

            let subtotal = p.precio * p.cantidad;
            let totalItem = subtotal - p.descuento + p.impuesto;

            subtotalGeneral += subtotal;

            tabla.row.add([
                i + 1,
                p.nombre,
                `<input type="number" value="${p.cantidad}" min="1"
                    class="form-control form-control-sm cantidad"
                    data-index="${i}">`,
                p.precio.toFixed(2),
                subtotal.toFixed(2),
                `<input type="number" value="${p.descuento}" min="0"
                    class="form-control form-control-sm descuento"
                    data-index="${i}">`,
                `<input type="number" value="${p.impuesto}" min="0"
                    class="form-control form-control-sm impuesto"
                    data-index="${i}">`,
                totalItem.toFixed(2),
                `<button class="btn btn-danger btn-sm eliminar" data-index="${i}">X</button>`
            ]);
        });

        tabla.draw();

        calcularTotales(subtotalGeneral);
    }

/*═══════════════════════════════════════════════════*/
/* 🔄 EVENTOS DINÁMICOS */

    $('#tabla_carrito').on('input', '.cantidad', function () {
        let i = $(this).data('index');
        carrito[i].cantidad = parseInt($(this).val()) || 1;
        renderCarrito();
    });

    $('#tabla_carrito').on('input', '.descuento', function () {
        let i = $(this).data('index');
        carrito[i].descuento = parseFloat($(this).val()) || 0;
        renderCarrito();
    });

    $('#tabla_carrito').on('input', '.impuesto', function () {
        let i = $(this).data('index');
        carrito[i].impuesto = parseFloat($(this).val()) || 0;
        renderCarrito();
    });

    $('#tabla_carrito').on('click', '.eliminar', function () {
        let i = $(this).data('index');
        carrito.splice(i, 1);
        renderCarrito();
    });

/*═══════════════════════════════════════════════════*/
/* 💰 TOTALES */

    function calcularTotales(subtotalGeneral) {

        let descuento = parseFloat($('#descuento').val()) || 0;
        let impuesto = parseFloat($('#impuesto').val()) || 0;

        let total = subtotalGeneral - descuento + impuesto;

        $('#subtotal').val(subtotalGeneral.toFixed(2));
        $('#total').val(total.toFixed(2));
    }

    $('#descuento, #impuesto').on('input', function () {
        let subtotal = parseFloat($('#subtotal').val()) || 0;
        calcularTotales(subtotal);
    });

/*═══════════════════════════════════════════════════*/
/* 🧹 LIMPIAR */

    $('#btnLimpiar').click(function () {

        carrito = [];
        renderCarrito();

        $('#proveedor').val(null).trigger('change');
        $('#tipo_factura').val(null).trigger('change');
        $('#metodo_pago').val(null).trigger('change');
        $('#cuenta').val(null).trigger('change');

        $('#numero_factura').val('');
        $('#subtotal').val('');
        $('#total').val('');
        $('#descuento').val(0);
        $('#impuesto').val(0);
    });

/*═══════════════════════════════════════════════════*/
/* 💾 REGISTRAR COMPRA */

    $('#btnRegistrar').click(function () {

        let data = {
            numero_factura: $('#numero_factura').val(),
            proveedor: $('#proveedor').val(),
            tipo_factura: $('#tipo_factura').val(),
            metodo_pago: $('#metodo_pago').val(),
            cuenta: $('#cuenta').val(),
            descuento: $('#descuento').val(),
            impuesto: $('#impuesto').val(),
            total: $('#total').val(),
            carrito: carrito
        };

        // 🔴 VALIDACIONES
        if (!data.proveedor) return alert('Seleccione proveedor');
        if (!data.tipo_factura) return alert('Seleccione tipo factura');
        if (!data.metodo_pago) return alert('Seleccione método de pago');
        if (carrito.length === 0) return alert('Agregue productos');

        $.ajax({
            url: '/compras/registrar',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {

                if (res.success) {
                    alert('Compra registrada');

                    $('#btnLimpiar').click();
                }
            },
            error: function () {
                alert('Error al registrar');
            }
        });
    });

/*═══════════════════════════════════════════════════*/

});