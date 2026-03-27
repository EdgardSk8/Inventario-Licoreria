$(document).ready(function () {

/* ------------------------------------------------------------------------------------------------------------------- */

/* 🔹 VARIABLES */

    let carrito = [];

    let tabla = $('#tabla_carrito').DataTable({
        paging: false,
        searching: false,
        info: false,
        ordering: false
    });

/* ------------------------------------------------------------------------------------------------------------------- */

/*  ╔════════════════════ Selectores Select2 ═══════════════════╗ 
    ╚═══════════════════════════════════════════════════════════╝ */

/* ═════════════ (SELECT2 PROVEEDOR) ═══════════════ */

    $('#proveedor').select2({

        ajax: { url: '/proveedores-compra/mostrar', dataType: 'json',

            processResults: function (res) { return {  results: res.data }; }

        }

    });

/* ----------------------------------------------------- */

/* ═════════════ (SELECT2 PRODUCTOS) ═══════════════ */

    $('#producto_select').select2({ 
        
        ajax: { url: '/productos-compra/mostrar', dataType: 'json',

            processResults: function (res) { return { results: res.data }; }

        }

    });

/* ------------------------------------------------------------------------------------------------------------------- */

/*  ╔════════════════════ Selectores Comunes ═══════════════════╗ 
    ╚═══════════════════════════════════════════════════════════╝ */

/* ═════════════ ( SELECTOR TIPOS DE FACTURA ) ═══════════════ */

    function cargarTiposFactura() {

        $.get('/tipo-factura-compra/mostrar', function(res){

            let html = '<option value="" disabled selected>Seleccione tipo factura</option>';
            res.data.forEach(t => { html += `<option value="${t.id_tipo_factura}">${t.nombre_tipo_factura}</option>`; } );
            $('#tipo_factura').html(html);

        });
    }

    cargarTiposFactura();

/* ----------------------------------------------------- */

/* ═════════════ ( SELECTOR METODO DE PAGO ) ═══════════════ */

    function cargarMetodosPago() {

        $.get('/metodo-pago-compra/mostrar', function(res){

            let html = '<option value="" disabled selected>Seleccione método</option>';
            res.data.forEach(m => { html += `<option value="${m.id_metodo_pago}">${m.nombre_metodo_pago}</option>`; } );
            $('#metodo_pago').html(html);

        });
    }

    cargarMetodosPago();


/* ----------------------------------------------------- */

/* ═════════════ ( HABILITA/DESHABILITA SELECTORES ) ═══════════════ */

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

/* ----------------------------------------------------- */

/* ═════════════ ( SELECTOR CUENTAS ) ═══════════════ */

    function cargarCuentas() {

        $.get('/cuenta-compra/mostrar', function(res) {

            const html = ['<option value="" disabled selected>Seleccione cuenta</option>']
                .concat(res.data.map(c => 
                    `<option value="${c.id_cuenta}">${c.nombre_cuenta} (C$ ${parseFloat(c.saldo_actual).toFixed(2)})</option>`
                )).join('');

            $('#cuenta').html(html);

        });

    }

    cargarCuentas();

/* ----------------------------------------------------- */

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

/* --------------------------------------------------------------------------------------------- */

/* ═════════════ ( RECALCULADOR DE PRECIOS ) ═══════════════ */

    $('#total, #descuento, #impuesto').on('input', actualizarCajas); 

/* --------------------------------------------------------------------------------------------- */



/*═══════════════════════════════════════════════════*/
/* ➕ AGREGAR PRODUCTO */

$('#btnAgregar').click(function () {
    let data = $('#producto_select').select2('data')[0];
    let cantidad = parseInt($('#cantidad').val());
    let precio = parseFloat($('#precio').val());
    let descuento = parseFloat($('#descuento_item').val()) || 0;
    let impuesto = parseFloat($('#impuesto_item').val()) || 0;

    if (!data) return alert('Seleccione producto');
    if (cantidad <= 0) return alert('Cantidad inválida');
    //if (precio <= 0) return alert('Precio inválido');

    let existente = carrito.find(p => p.id === data.id);

    if (existente) {
        existente.cantidad += cantidad;
        existente.precio = precio; // actualizar precio manual
        existente.descuento = descuento;
        existente.impuesto = impuesto;
    } else {
        carrito.push({
            id: data.id,
            nombre: data.text,
            precio: precio,
            cantidad: cantidad,
            descuento: descuento,
            impuesto: impuesto
        });
    }

    renderCarrito();

    // limpiar inputs
    $('#producto_select').val(null).trigger('change');
    // limpiar inputs con placeholder
    $('#cantidad').val('').attr('placeholder', '0');
    $('#precio').val('').attr('placeholder', '0');
    $('#descuento_item').val('').attr('placeholder', '0'); // aunque ya no uses descuento, si quieres mantener
    $('#impuesto_item').val('').attr('placeholder', '0');  // idem
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
            `<input type="number" value="${p.cantidad}" min="0" placeholder="0"
                class="form-control form-control-sm cantidad"
                data-index="${i}">`,
            `<input type="number" value="${p.precio}" min="0" placeholder="0"
                class="form-control form-control-sm precio"
                data-index="${i}">`,
            totalItem.toFixed(2),
            `<button class="btn btn-danger btn-sm eliminar" data-index="${i}">
                <i class="bi bi-trash"></i>
            </button>`
        ]);
    });

    tabla.draw();
    calcularTotales(subtotalGeneral);
}

/*═══════════════════════════════════════════════════*/
/* 🔄 EVENTOS DINÁMICOS */

$('#tabla_carrito').on('blur', '.cantidad, .precio, .descuento, .impuesto', function () {
    let i = $(this).data('index');
    let clase = $(this).attr('class').split(' ')[2]; // cantidad, precio, descuento, impuesto
    let valor = parseFloat($(this).val()) || 0;

    carrito[i][clase] = valor;

    // recalcular totales
    calcularTotales(carrito.reduce((acc, p) => acc + (p.precio * p.cantidad), 0));

    // opcional: actualizar cajas si necesitas
    actualizarCajas(); renderCarrito();
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
        descuento: parseFloat($('#descuento').val()) || 0,
        impuesto: parseFloat($('#impuesto').val()) || 0,
        total: parseFloat($('#total').val()) || 0,
        carrito: carrito
    };

    // VALIDACIONES
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
            } else {
                alert(res.error || 'Error desconocido');
            }
        },
        error: function (xhr) {
            let msg = xhr.responseJSON?.error || 'Error al registrar';
            alert(msg);
        }
    });
});

});