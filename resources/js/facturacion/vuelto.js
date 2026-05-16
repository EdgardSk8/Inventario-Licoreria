(function () {

    /* ═══════ Variables Globales POS ═════════ */

    let TASA = 0;
    let bloqueando = false;
    let ultimaMoneda = 'C';
    let metodoPagoActual = 'efectivo';

    /*  ════════ Inicialización ═════════ */

    function init() { cargarTipoCambio(); eventos(); }

    /*  ════════ Obtener Tipo de Cambio ═════════ */

    function cargarTipoCambio() {

        $.get('/tipo-cambio/pos', function (res) {

            if (res.success) {

                TASA = parseFloat(res.tasa) || 0;
                $('#tasaImpuesto').text( 'Cambio: 1 Dolar = ' + TASA + ' Cordobas' );

            }

        });
    }

    /* ═══════ Cálculo de Vueltos ═════════ */

   window.calcularVueltos = function() {

        if (metodoPagoActual !== 'efectivo') {

            $('#vueltoCordobas').val('C$ 0.00');
            $('#vueltoDolares').val('$ 0.00');
            return;
        }

        if (!TASA) return;

        let total = parseFloat( $('#total').text().replace(/[^\d.-]/g, '') ) || 0;
        let pagoC = parseFloat($('#pagoCordobas').val()) || 0;
        let pagoD = parseFloat($('#pagoDolares').val()) || 0;

        let totalPagadoC = (ultimaMoneda === 'C') ? pagoC : pagoD * TASA;
        let vueltoC = totalPagadoC - total;

        if (vueltoC < 0) {
            $('#vueltoCordobas').val('C$ 0.00'); $('#vueltoDolares').val('$ 0.00'); return;
        }

        let vueltoD = vueltoC / TASA;
        $('#vueltoCordobas').val('C$ ' + vueltoC.toFixed(2));
        $('#vueltoDolares').val('$ ' + vueltoD.toFixed(2));

    }

    /* ════════ Cambiar Método de Pago ═════════ */

    function setMetodoPago(metodo) {

        metodoPagoActual = metodo;

        if (metodo === 'efectivo') {

            $('#pagoCordobas').prop('disabled', false);
            $('#pagoDolares').prop('disabled', false);

            calcularVueltos();

        } else {

            $('#pagoCordobas').prop('disabled', true);
            $('#pagoDolares').prop('disabled', true);

            $('#vueltoCordobas').val('C$ 0.00');
            $('#vueltoDolares').val('$ 0.00');
        }
    }

    /* ════════ Eventos ═════════ */

    function eventos() {

        $('#pagoCordobas').off('input').on('input', function () {

            if (
                bloqueando ||
                !TASA ||
                metodoPagoActual !== 'efectivo'
            ) return;

            bloqueando = true;
            ultimaMoneda = 'C';

            let valor = parseFloat($(this).val()) || 0;
            let enDolares = valor / TASA;

            $('#pagoDolares').val(enDolares.toFixed(2));

            calcularVueltos();

            bloqueando = false;
        });

        $('#pagoDolares').off('input').on('input', function () {

            if (
                bloqueando ||
                !TASA ||
                metodoPagoActual !== 'efectivo'
            ) return;

            bloqueando = true;
            ultimaMoneda = 'D';

            let valor = parseFloat($(this).val()) || 0;
            let enCordobas = valor * TASA;

            $('#pagoCordobas').val(enCordobas.toFixed(2));

            calcularVueltos();

            bloqueando = false;
        });

        $('.metodo-pago').off('click').on('click', function () {
            let metodo = $(this).data('metodo');
            setMetodoPago(metodo);
        });
        
    }

    init();

})();