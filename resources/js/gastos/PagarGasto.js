
$(document).ready(function () {

    /* ═══════════════════════════════
        CARGAR CAJAS
    ═══════════════════════════════ */
    function cargarCajas() {

        $.get('/gastos-cajas/mostrar', function (res) {

            if (!res.success) return;

            let html = '<option value="">Seleccione caja</option>';

            res.cajas.forEach(caja => {
                html += `<option value="${caja.id}" data-saldo="${caja.saldo}">
                            ${caja.display}
                         </option>`;
            });

            $('#pagar_id_caja').html(html);
        });
    }

    /* ═══════════════════════════════
        CARGAR CUENTAS
    ═══════════════════════════════ */
    function cargarCuentas() {

        $.get('/gastos-cuentas/mostrar', function (res) {

            if (!res.success) return;

            let html = '<option value="">Seleccione cuenta</option>';

            res.cuentas.forEach(cuenta => {
                html += `<option value="${cuenta.id}" data-saldo="${cuenta.saldo}">
                            ${cuenta.display}
                         </option>`;
            });

            $('#pagar_id_cuenta').html(html);
        });
    }

    function validarPago({ monto, id_caja, id_cuenta, fecha }) {

    // ❌ monto vacío
    if (!monto) {
        mostrarToast('Debe ingresar un monto', 'danger');
        return false;
    }

    // ❌ monto cero
    if (monto == 0) {
        mostrarToast('No se permiten pagos en 0', 'danger');
        return false;
    }

    // ❌ monto negativo
    if (monto < 0) {
        mostrarToast('No se permiten pagos negativos', 'danger');
        return false;
    }

    // ❌ sin caja ni cuenta
    if (!id_caja && !id_cuenta) {
        mostrarToast('Debe seleccionar una caja o cuenta', 'danger');
        return false;
    }

    // ❌ ambos seleccionados
    if (id_caja && id_cuenta) {
        mostrarToast('Seleccione solo caja o cuenta, no ambos', 'danger');
        return false;
    }

    // ❌ fecha inválida (si aplica)
    if (fecha && isNaN(new Date(fecha).getTime())) {
        mostrarToast('La fecha ingresada no es válida', 'danger');
        return false;
    }

    return true;
}

    /* ═══════════════════════════════
        SOLO UNO (CAJA / CUENTA)
    ═══════════════════════════════ */
    $('#pagar_id_caja').on('change', function () {
        if ($(this).val()) $('#pagar_id_cuenta').val('');
    });

    $('#pagar_id_cuenta').on('change', function () {
        if ($(this).val()) $('#pagar_id_caja').val('');
    });

    /* ═══════════════════════════════
        VALIDAR SALDO
    ═══════════════════════════════ */
    function validarSaldo() {

        const monto = parseFloat($('#pagar_monto').val());
        if (!monto || monto <= 0) return;

        const cajaOption = $('#pagar_id_caja option:selected');
        const cuentaOption = $('#pagar_id_cuenta option:selected');

        const saldoCaja = parseFloat(cajaOption.data('saldo') || 0);
        const saldoCuenta = parseFloat(cuentaOption.data('saldo') || 0);

        if ($('#pagar_id_caja').val() && monto > saldoCaja) {
            mostrarToast('El monto supera el saldo de caja', 'danger');
        }

        if ($('#pagar_id_cuenta').val() && monto > saldoCuenta) {
            mostrarToast('El monto supera el saldo de cuenta', 'danger');
        }
    }

    $('#pagar_monto').on('input', validarSaldo);

    /* ═══════════════════════════════
        ABRIR MODAL (CORREGIDO)
    ═══════════════════════════════ */
    $('#tablaGastos').on('click', '.pagarGasto', function () {

        const tabla = $('#tablaGastos').DataTable();
        const fila = tabla.row($(this).closest('tr')).data();

        if (!fila) return;

        // 🔥 abrir modal primero
        const modal = new bootstrap.Modal(document.getElementById('modalPagarGasto'));
        modal.show();

        // 🔥 llenar datos después de abrir
        setTimeout(() => {

            $('#pagar_id_gasto').val(fila.id_gasto);
            $('#pagar_nombre_gasto').val(fila.nombre_gasto);
            $('#pagar_ultimo_pago').val(fila.ultimo_pago_fecha ?? 'Nunca');
            $('#pagar_ultimo_pago').val(
                fila.ultimo_pago_fecha
                    ? formatearFechaDiaHora(fila.ultimo_pago_fecha)
                    : 'Nunca'
            );
            $('#pagar_ultimo_monto').val(fila.ultimo_pago_monto ?? '0.00');

            $('#pagar_monto').val(fila.ultimo_pago_monto ?? '');

            $('#pagar_id_caja').val('');
            $('#pagar_id_cuenta').val('');

            $('#pagar_renovar_fecha').val('auto');
            $('#grupo_fecha_manual').addClass('d-none');
            $('#pagar_nueva_fecha').val('');

            cargarCajas();
            cargarCuentas();

        }, 150);
    });

    /* ═══════════════════════════════
        PAGAR (ANTI DOBLE CLICK)
    ═══════════════════════════════ */
    $('#btnPagarGasto').on('click', function () {

        const btn = $(this);

        if (btn.data('loading')) return;

        const id_gasto = $('#pagar_id_gasto').val();
        const monto = parseFloat($('#pagar_monto').val());
        const id_caja = $('#pagar_id_caja').val();
        const id_cuenta = $('#pagar_id_cuenta').val();

        const renovar = $('#pagar_renovar_fecha').val();
        const nueva_fecha = $('#pagar_nueva_fecha').val();

        // ✔ VALIDACIÓN CENTRALIZADA
        if (!validarPago({
            monto,
            id_caja,
            id_cuenta,
            fecha: nueva_fecha
        })) {
            return;
        }

        btn.data('loading', true).prop('disabled', true);

        $.ajax({
            url: '/gastos/pagar',
            method: 'POST',
            data: {
                id_gasto,
                monto,
                id_caja: id_caja || null,
                id_cuenta: id_cuenta || null,
                renovar_vencimiento: renovar,
                nueva_fecha: nueva_fecha || null,
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            success: function (res) {

                if (res.success) {

                    mostrarToast('Pago registrado correctamente', 'success');

                    bootstrap.Modal.getInstance(
                        document.getElementById('modalPagarGasto')
                    ).hide();

                    $('#tablaGastos').DataTable().ajax.reload(null, false);
                } else {
                    mostrarToast(res.mensaje || 'Error al pagar', 'danger');
                }
            },

            error: function () {
                mostrarToast('Error del servidor', 'danger');
            },

            complete: function () {
                btn.data('loading', false).prop('disabled', false);
            }
        });
    });

    
$('#pagar_renovar_fecha').on('change', function () {

    const valor = $(this).val();

    if (valor === 'manual') {
        $('#grupo_fecha_manual').removeClass('d-none');
    } else {
        $('#grupo_fecha_manual').addClass('d-none');
        $('#pagar_nueva_fecha').val('');
    }
});

    /* ═══════════════════════════════
        LIMPIAR MODAL (CORRECTO)
    ═══════════════════════════════ */
    function limpiarPago() {

        $('#formPagarGasto')[0].reset();

        $('#pagar_id_gasto').val('');
        $('#pagar_id_caja').val('');
        $('#pagar_id_cuenta').val('');

        $('#grupo_fecha_manual').addClass('d-none');
        $('#pagar_nueva_fecha').val('');
    }

    /* ✔ limpiar al cerrar modal */
    $('#modalPagarGasto').on('hidden.bs.modal', function () {
        limpiarPago();
    });

});