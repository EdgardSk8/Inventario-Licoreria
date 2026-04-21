$(document).ready(function () {

    let cuentas = [];

    /* ═══════════════════════════════════════════════════ */
    /* ABRIR MODAL */
    /* ═══════════════════════════════════════════════════ */
    $('#ModalTransferirCuenta').on('show.bs.modal', function () {
        cargarCuentas();
        resetFormulario();
    });

    /* ═══════════════════════════════════════════════════ */
    /* CARGAR CUENTAS */
    /* ═══════════════════════════════════════════════════ */
    function cargarCuentas() {

        $.get('/cuenta/mostrarselector', function (res) {

            if (!res.success) return;

            cuentas = res.cuentas;

            let opciones = '<option value="" disabled selected>Seleccione Cuenta de Origen</option>';

            cuentas.forEach(c => {
                opciones += `<option value="${c.id}" data-saldo="${c.saldo_actual}">
                                ${c.display}
                             </option>`;
            });

            $('#cuenta_origen').html(opciones);
            $('#cuenta_destino')
                .html('<option value="" disabled selected>Seleccione Cuenta de Destino</option>')
                .prop('disabled', true);
        });
    }

    /* ═══════════════════════════════════════════════════ */
    /* CAMBIO CUENTA ORIGEN */
    /* ═══════════════════════════════════════════════════ */
    $('#cuenta_origen').on('change', function () {

        let origenId = $(this).val();

        let opciones = '<option value="" disabled selected>Seleccione Cuenta de Origen</option>';

        cuentas.forEach(c => {
            if (c.id != origenId) {
                opciones += `<option value="${c.id}" data-saldo="${c.saldo_actual}">
                                ${c.display}
                             </option>`;
            }
        });

        $('#cuenta_destino')
            .html(opciones)
            .prop('disabled', false);

        actualizarSaldos();
        calcularResultados();
    });

    /* ═══════════════════════════════════════════════════ */
    /* CAMBIO CUENTA DESTINO */
    /* ═══════════════════════════════════════════════════ */
    $('#cuenta_destino').on('change', function () {
        actualizarSaldos();
        calcularResultados();
    });

    /* ═══════════════════════════════════════════════════ */
    /* INPUT MONTO */
    /* ═══════════════════════════════════════════════════ */
    $('#monto_transferencia').on('input', function () {
        calcularResultados();
    });

    /* ═══════════════════════════════════════════════════ */
    /* ACTUALIZAR SALDOS */
    /* ═══════════════════════════════════════════════════ */
    function actualizarSaldos() {

        let origen = $('#cuenta_origen').val();
        let destino = $('#cuenta_destino').val();

        if (!origen) {
            $('#saldo_origen').val('');
        } else {
            let saldoOrigen = parseFloat($('#cuenta_origen option:selected').data('saldo')) || 0;
            $('#saldo_origen').val(formatear(saldoOrigen));
        }

        if (!destino) {
            $('#saldo_destino').val('');
        } else {
            let saldoDestino = parseFloat($('#cuenta_destino option:selected').data('saldo')) || 0;
            $('#saldo_destino').val(formatear(saldoDestino));
        }
    }

    /* ═══════════════════════════════════════════════════ */
    /* CALCULAR RESULTADOS */
    /* ═══════════════════════════════════════════════════ */
    function calcularResultados() {

        let monto = parseFloat($('#monto_transferencia').val());

        if (!monto || monto <= 0) {
            $('#saldo_origen_resultante').val('');
            $('#saldo_destino_resultante').val('');
            return;
        }

        let saldoOrigen = parseFloat($('#cuenta_origen option:selected').data('saldo')) || 0;
        let saldoDestino = parseFloat($('#cuenta_destino option:selected').data('saldo')) || 0;

        $('#saldo_origen_resultante').val(formatear(saldoOrigen - monto));
        $('#saldo_destino_resultante').val(formatear(saldoDestino + monto));
    }

    /* ═══════════════════════════════════════════════════ */
    /* FORMATEAR MONEDA */
    /* ═══════════════════════════════════════════════════ */
    function formatear(valor) {
        return 'C$ ' + Number(valor).toLocaleString('es-NI', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    /* ═══════════════════════════════════════════════════ */
    /* CONCEPTO SWITCH */
    /* ═══════════════════════════════════════════════════ */
    $('#usar_input_concepto').on('change', function () {
        $('#grupo_selector_concepto').toggleClass('d-none', this.checked);
        $('#grupo_input_concepto').toggleClass('d-none', !this.checked);
    });

    /* ═══════════════════════════════════════════════════ */
    /* TRANSFERIR */
    /* ═══════════════════════════════════════════════════ */
    $('#btnTransferir').on('click', function () {

        let btn = $(this);

        let data = {
            cuenta_origen: $('#cuenta_origen').val(),
            cuenta_destino: $('#cuenta_destino').val(),
            monto: $('#monto_transferencia').val(),
            descripcion: $('#usar_input_concepto').is(':checked')
                ? $('#input_concepto').val()
                : $('#selector_concepto').val()
        };

        if (!data.cuenta_origen || !data.cuenta_destino || !data.monto) {
            mostrarToast('Completa todos los campos', 'danger');
            return;
        }

        btn.prop('disabled', true).text('Procesando...');

        $.ajax({
            url: '/cuenta/transferir',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {

                if (res.success) {
                    mostrarToast(res.mensaje, 'success');
                    $('#ModalTransferirCuenta').modal('hide');

                    if (typeof tabla !== 'undefined') {
                        tabla.ajax.reload();
                    }

                } else {
                    mostrarToast(res.mensaje || 'Error', 'error');
                }
            },
            error: function (xhr) {

                if (xhr.status === 422) {
                    let errores = xhr.responseJSON.errors;
                    let mensaje = Object.values(errores)[0][0];
                    mostrarToast(mensaje, 'danger');
                } else {
                    mostrarToast('Error en la transferencia', 'error');
                }
            },
            complete: function () {
                btn.prop('disabled', false).text('Transferir');
            }
        });

    });

    /* ═══════════════════════════════════════════════════ */
    /* RESET FORMULARIO */
    /* ═══════════════════════════════════════════════════ */
    function resetFormulario() {

        $('#monto_transferencia').val('');
        $('#saldo_origen').val('');
        $('#saldo_destino').val('');
        $('#saldo_origen_resultante').val('');
        $('#saldo_destino_resultante').val('');

        $('#cuenta_origen').prop('selectedIndex', 0);
        $('#cuenta_destino')
            .prop('disabled', true)
            .html('<option value="" disabled selected>Seleccione...</option>');

        $('#usar_input_concepto').prop('checked', false);
        $('#grupo_input_concepto').addClass('d-none');
        $('#grupo_selector_concepto').removeClass('d-none');
    }

});