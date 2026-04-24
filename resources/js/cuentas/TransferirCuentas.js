$(document).ready(function () {

    let cuentas = []; // Variable de estado

/* ═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */
/* ═══════════════════════════════════════════════════════ EVENTOS ═══════════════════════════════════════════════════════ */
/* ═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

    /* ═════════ Evento Abrir Modal ═════════ */

    $('#ModalTransferirCuenta').on('show.bs.modal', function () { cargarCuentas(); resetFormulario(); });

    /* ══════════ Evento de Cambio ══════════ */

    $('#cuenta_origen').on('change', function () {

        let origenId = $(this).val();
        let opciones = '<option value="" disabled selected>Seleccione Cuenta</option>';

        cuentas.forEach(c => {
            if (c.id != origenId) { opciones += `<option value="${c.id}" data-saldo="${c.saldo_actual}"> ${c.display} </option>`; }
        });

        $('#cuenta_destino') .html(opciones).prop('disabled', false); //Option deshabilitado

        recalcularUI();

    });

    /* ══════════ Evento de Cambio ══════════ */

    $('#cuenta_destino').on('change', function () { recalcularUI(); });

    /* ══════════ Evento Formatedor ══════════ */

    $('#monto_transferencia').on('input', function () {

        let valor = this.value.replace(/[^0-9.]/g, '');
        let partes = valor.split('.');

        if (partes.length > 2) { valor = partes[0] + '.' + partes[1]; partes = valor.split('.'); }
        if (valor.endsWith('.')) { this.value = 'C$ ' + valor; return; }
        if (!valor) { this.value = ''; calcularResultados(); return; }
        let numero = parseFloat(valor);
        if (isNaN(numero)) return;

        this.value = 'C$ ' + numero.toLocaleString('es-NI', {

            minimumFractionDigits: partes[1] ? partes[1].length : 0,
            maximumFractionDigits: 2

        });

        calcularResultados();

    });

    /* ═════════ Evento de cambio UI ═════════ */

    $('#check_concepto').on('change', function () {
        $('#grupo_selector_concepto').toggleClass('d-none', this.checked);
        $('#grupo_input_concepto').toggleClass('d-none', !this.checked);
    });

    /* ══════ Evento Click con peticion ══════ */

    $('#btnTransferir').on('click', function () {

        let btn = $(this); // Referencia al elemento actual

        /* ══════════════ Objeto de datos ══════════════ */

        let data = { 
            cuenta_origen: $('#cuenta_origen').val(), 
            cuenta_destino: $('#cuenta_destino').val(),
            monto: obtenerMontoLimpio(), 
            descripcion: $('#check_concepto').is(':checked')
                ? $('#input_concepto').val()
                : $('#selector_concepto').val()
        };

        /*  ════════ Cláusulas de guarda (Validaciones) ════════ */

        if (!data.cuenta_origen) { mostrarToast('Seleccione una Cuenta de salida', 'danger'); return; }
        if (!data.cuenta_destino) { mostrarToast('Seleccione una cuenta entrada', 'danger'); return;}
        if (!data.monto) { mostrarToast('Ingrese saldo a transferir', 'danger'); return; }

        /*  ════════════════════════════════════════════════════ */

        btn.prop('disabled', true).text('Procesando Transferencia'); // Evita doble click deshabilitando

        /*  ═════════════════ LLAMADA HTTP ══════════════════════ */

        $.ajax({ url: '/cuenta/transferir', method: 'POST', data: data, headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (res) {

                if (res.success) { mostrarToast(res.mensaje, 'success'); $('#ModalTransferirCuenta').modal('hide');
                    if ($.fn.DataTable.isDataTable('#tablaCuentas')) { $('#tablaCuentas').DataTable().ajax.reload(); }
                } else { mostrarToast(res.mensaje || 'Error', 'error'); }

            },
            error: function (xhr) {

                console.log('❌ ERROR AJAX COMPLETO:', xhr);

                if (xhr.status === 422) { const errores = xhr.responseJSON?.errors || {}; const mensaje = Object.values(errores)[0]?.[0];
                    console.log('⚠️ ERROR DE VALIDACIÓN:', mensaje);
                }
                mostrarToast('Error en la transferencia', 'error');
            },
            complete: function () { btn.prop('disabled', false).text('Transferir'); }
            
        });

    });

/* ═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */
/* ══════════════════════════════════════════════════════ FUNCIONES ══════════════════════════════════════════════════════ */
/* ═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

    /* ══════════ Reinicio de Interfaz ══════════ */
   
    function resetFormulario() {

        $('#monto_transferencia').val('');
        $('#saldo_origen').val('');
        $('#saldo_destino').val('');
        $('#saldo_origen_resultante').val('');
        $('#saldo_destino_resultante').val('');
        $('#cuenta_origen').prop('selectedIndex', 0);
        $('#check_concepto').prop('checked', false);
        $('#grupo_input_concepto').addClass('d-none');
        $('#grupo_selector_concepto').removeClass('d-none');

    }

    /* ══ Función de retorno (Peticion HTTP) ══ */

    function cargarCuentas() {

        $.get('/cuenta/mostrarselector', function (res) {

            if (!res.success) return;
            cuentas = res.cuentas;
            let opciones = '<option value="" disabled selected>Seleccione Cuenta de Origen</option>';
            cuentas.forEach(c => { opciones += `<option value="${c.id}" data-saldo="${c.saldo_actual}"> ${c.display} </option>`; });
            $('#cuenta_origen').html(opciones);
            $('#cuenta_destino') .html('<option value="" disabled selected>Seleccione Cuenta de Destino</option>') .prop('disabled', true);

        });
    }

    /* ═════════ Funcion Utilitaria ═════════ */

    function obtenerMontoLimpio() {
        let texto = $('#monto_transferencia').val();
        return parseFloat( texto.replace('C$', '').replace(/,/g, '')) || 0;
    }

    /* ═══ Función de sincronizacion de UI ═══ */

    function actualizarSaldos() {

        const setSaldo = (selectorOrigen, selectorDestino) => {

            const valor = $(selectorOrigen).val();
            if (!valor) { $(selectorDestino).val(''); return; }
            const saldo = parseFloat( $(selectorOrigen + ' option:selected').data('saldo')) || 0;
            $(selectorDestino).val(formatear(saldo));

        };

        setSaldo('#cuenta_origen', '#saldo_origen');
        setSaldo('#cuenta_destino', '#saldo_destino');
    }

    /* Funcion híbrida (logica de negocio + actualizacion de UI) */

    function calcularResultados() {

        let monto = obtenerMontoLimpio();
        let saldoOrigen = parseFloat($('#cuenta_origen option:selected').data('saldo')) || 0;
        let saldoDestino = parseFloat($('#cuenta_destino option:selected').data('saldo')) || 0;
        $('#saldo_origen_resultante').val(formatear(saldoOrigen - monto));
        $('#saldo_destino_resultante').val(formatear(saldoDestino + monto));

    }

    /* ═════════ Funcion Utilitaria ═════════ */

    function formatear(valor) {

        return 'C$ ' + Number(valor).toLocaleString('es-NI', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

    }

    /* ════════ Funcion Coordinadora ════════ */

    function recalcularUI() {
        actualizarSaldos();
        calcularResultados();
    }

});