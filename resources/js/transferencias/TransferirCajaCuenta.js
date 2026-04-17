window.saldoCaja = window.saldoCaja ?? 0;

/* =========================
   EVENTO PRINCIPAL
========================= */
$('#tablaCajaCuenta').on('click', '.btn-transferir', function () {

    const row = obtenerFilaCaja(this);
    if (!row) return;

    llenarModalCaja(row);
    resetModalTransferencia();
    cargarCuentas();

    new bootstrap.Modal(document.getElementById('modalTransferir')).show();
});


/* =========================
   OBTENER FILA DATATABLE
========================= */
function obtenerFilaCaja(btn) {
    const tabla = $('#tablaCajaCuenta').DataTable();
    return tabla.row($(btn).closest('tr')).data();
}


/* =========================
   LLENAR MODAL
========================= */
function llenarModalCaja(row) {

    $('#id_caja').val(row.numero_caja);
    $('#infoCaja').text('#' + row.numero_caja);

    $('#infoFecha').text(
        row.fecha_cierre ? formatearFechaDia(row.fecha_cierre) : '—'
    );

    $('#infoInicial').text(
        'C$ ' + (parseFloat(row.monto_final) || 0).toFixed(2)
    );

    // =========================
    // SALDO REAL (FUENTE ÚNICA)
    // =========================
    const inicial = parseFloat(row.monto_inicial) || 0;
    const transferido = parseFloat(row.monto_transferido) || 0;

    saldoCajaActual = (row.saldo_caja !== null && row.saldo_caja !== undefined)
        ? parseFloat(row.saldo_caja)
        : (inicial - transferido);

    $('#infoFinal')
        .text('C$ ' + saldoCajaActual.toFixed(2))
        .removeClass('text-success text-danger')
        .addClass(saldoCajaActual > 0 ? 'text-success' : 'text-danger');
}


/* =========================
   RESET MODAL
========================= */
function resetModalTransferencia() {
    $('#monto').val('');
    $('#saldo_restante').val('').removeClass('text-success text-danger');
    $('#cuenta').val('');
}


/* =========================
   CARGAR CUENTAS
========================= */
function cargarCuentas() {

    $.get('/cuenta-compra/mostrar', function (res) {

        const select = $('#cuenta');
        select.html('<option value="" disabled selected>Seleccione cuenta</option>');

        if (res.success && Array.isArray(res.cuentas)) {
            res.cuentas.forEach(c => {
                select.append(`<option value="${c.id}">${c.display}</option>`);
            });
        }
    });
}


/* =========================
   CALCULAR SALDO RESTANTE
========================= */
$('#monto').on('input', function () {

    const monto = parseFloat($(this).val()) || 0;
    const restante = saldoCajaActual - monto;

    $('#saldo_restante')
        .val('C$ ' + restante.toFixed(2))
        .removeClass('text-success text-danger')
        .addClass(restante >= 0 ? 'text-success' : 'text-danger');
});


/* =========================
   GUARDAR TRANSFERENCIA
========================= */
$('#btnGuardarTransferencia').on('click', function () {

    const btn = $(this);
    btn.prop('disabled', true);

    const data = {
        idCaja: $('#id_caja').val(),
        idCuenta: $('#cuenta').val(),
        monto: parseFloat($('#monto').val()) || 0,
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    if (!validarTransferencia(data, btn)) return;

    enviarTransferencia(data, btn);
});


/* =========================
   VALIDACIÓN
========================= */
function validarTransferencia(data, btn) {

    if (!data.idCuenta) {
        mostrarToast('Seleccione una cuenta', 'danger');
        btn.prop('disabled', false);
        return false;
    }

    if (!data.monto || data.monto <= 0) {
        mostrarToast('Ingrese un monto válido', 'danger');
        btn.prop('disabled', false);
        return false;
    }

    if (data.monto > saldoCajaActual) {
        mostrarToast('No puedes transferir más de lo disponible en caja', 'danger');
        btn.prop('disabled', false);
        return false;
    }

    return true;
}


/* =========================
   AJAX TRANSFERENCIA
========================= */
function enviarTransferencia(data, btn) {

    $.ajax({
        url: '/movimientos-caja-cuenta/transferir',
        type: 'POST',
        data: {
            id_caja: data.idCaja,
            id_cuenta: data.idCuenta,
            monto: data.monto,
            _token: data._token
        },

        success: function (res) {

            if (res.success) {
                mostrarToast(res.mensaje, 'success');
                $('#modalTransferir').modal('hide');
                $('#tablaCajaCuenta').DataTable().ajax.reload();
            } else {
                mostrarToast(res.mensaje || 'Error al transferir', 'danger');
            }
        },

        error: function (err) {

            let mensaje = 'Error inesperado';

            if (err.responseJSON?.mensaje) {
                mensaje = err.responseJSON.mensaje;
            }

            mostrarToast(mensaje, 'danger');
        },

        complete: function () {
            btn.prop('disabled', false);
        }
    });
}