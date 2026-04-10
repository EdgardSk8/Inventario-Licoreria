$(document).ready(function () {

/* ------------------------------------------------------------------------------------------------------------------- */

/* 🔹 VARIABLES */

    let carrito = [];

    let tabla = $('#tabla_carrito').DataTable({
        paging: false,
        searching: false,
        info: false,
        ordering: false,
        ...Traduccion
    });

    document.getElementById('titulo').textContent = 'REGISTRO DE COMPRAS';

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
            let select = $('#cuenta');
            select.html('<option value="" disabled selected>Seleccione cuenta</option>');

            // Usar res.cuentas según tu JSON
            if(res.success && Array.isArray(res.cuentas)) {
                res.cuentas.forEach(function(c) {
                    select.append('<option value="' + c.id + '">' + c.display + '</option>');
                });
                
            }
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
console.log('DATA SELECT2:', $('#producto_select').select2('data'));
    $('#btnAgregar').click(function () {
        let data = $('#producto_select').select2('data')[0];
        let cantidad = parseInt($('#cantidad').val()) || 0;
        let precio = parseFloat($('#crear_precio_compra').val()) || 0;
        let descuento = parseFloat($('#descuento_item').val()) || 0;
        let impuesto = parseFloat($('#impuesto_item').val()) || 0;

        if (!data) return alert('Seleccione producto');
        //if (cantidad <= 0) return alert('Cantidad inválida');
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

            let precio = parseFloat(p.precio) || 0;
            let cantidad = parseFloat(p.cantidad) || 0;
            let descuento = parseFloat(p.descuento) || 0;
            let impuesto = parseFloat(p.impuesto) || 0;

            let subtotal = precio * cantidad;
            let totalItem = subtotal - descuento + impuesto;

            subtotalGeneral += subtotal;

            tabla.row.add([
                i + 1,
                p.nombre,
                `<input type="number" value="${cantidad}" min="0" placeholder="0"
                    class="form-control form-control-sm cantidad"
                    data-index="${i}">`,
                `<input type="number" value="${precio}" min="0" placeholder="0"
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
    let valor = parseFloat($(this).val()) || 0;

    if (carrito[i] === undefined) return;

    if ($(this).hasClass('cantidad')) {
        carrito[i].cantidad = valor;
    } 
    else if ($(this).hasClass('precio')) {
        carrito[i].precio = valor;
    } 
    else if ($(this).hasClass('descuento')) {
        carrito[i].descuento = valor;
    } 
    else if ($(this).hasClass('impuesto')) {
        carrito[i].impuesto = valor;
    }

    // 🔥 recalcular subtotal correctamente
    let subtotalGeneral = carrito.reduce((acc, p) => {
        return acc + ((p.precio || 0) * (p.cantidad || 0));
    }, 0);

    calcularTotales(subtotalGeneral);

    actualizarCajas();

    // 🔁 re-render para reflejar cambios
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

        let tipoPago = $('#cajacuentaselect').val();

        let data = {
            numero_factura: $('#numero_factura').val(),
            proveedor: $('#proveedor').val(),
            tipo_factura: $('#tipo_factura').val(),
            metodo_pago: $('#metodo_pago').val(),
            caja: tipoPago === 'caja' ? $('#caja_select').val() : null,
            cuenta: tipoPago === 'cuenta'? $('#cuenta').val() : null,
            descuento: parseFloat($('#descuento').val()) || 0,
            impuesto: parseFloat($('#impuesto').val()) || 0,
            carrito: carrito
        };

        // ✅ VALIDACIONES CON TOAST
        if (!data.proveedor) return mostrarToast('Seleccione proveedor', 'danger');
        if (!data.tipo_factura) return mostrarToast('Seleccione tipo factura', 'danger');
        if (!data.metodo_pago) return mostrarToast('Seleccione método de pago', 'danger');
        if (carrito.length === 0) return mostrarToast('Agregue productos', 'danger');

        if (!data.caja && !data.cuenta) {
            return mostrarToast('Seleccione caja o cuenta', 'danger');
        }

        // Verificar carrito: cantidad y precio
        for (let item of carrito) {
            if (item.cantidad <= 0) return mostrarToast(`Cantidad inválida para ${item.nombre}`, 'danger');
            if (item.precio <= 0) return mostrarToast(`Precio inválido para ${item.nombre}`, 'danger');
        }




        $.ajax({
            url: '/compra/crear', // ✅ CORREGIDO
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (res) {

                if (res.success) {

                    mostrarToast(res.mensaje || 'Compra registrada correctamente', 'success');

                    $('#btnLimpiar').click();

                } else {
                    mostrarToast(res.error || 'Error desconocido', 'danger');
                }
            },

            error: function (xhr) {

                // 🔥 VALIDACIONES LARAVEL (422)
                if (xhr.status === 422) {

                    let errores = xhr.responseJSON.errors;
                    let primerError = Object.values(errores)[0][0];

                    mostrarToast(primerError, 'danger');
                    return;
                }

                // 🔥 ERROR GENERAL
                let msg = xhr.responseJSON?.error || 'Error al registrar';
                mostrarToast(msg, 'danger');
            }
        });

    });

});