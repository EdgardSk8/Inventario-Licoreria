/*  ╔════════ Variables Globales POS ═════════╗ 
    ╚═════════════════════════════════════════╝ */

const TASA = 37;
let bloqueando = false;
let ultimaMoneda = 'C';

document.getElementById('tasaImpuesto').textContent = 'Cambio: 1 Dolar = ' + TASA + ' Cordobas';

/*  ╔════════ Cálculo de Vueltos ═════════╗ 
    ╚═════════════════════════════════════╝ */

function calcularVueltos() {

    let total = parseFloat($('#total').text().replace(/[^\d.-]/g, '')) || 0;
    let pagoC = parseFloat($('#pagoCordobas').val()) || 0;
    let pagoD = parseFloat($('#pagoDolares').val()) || 0;

    let totalPagadoC = 0;

    if (ultimaMoneda === 'C') { totalPagadoC = pagoC; } else { totalPagadoC = pagoD * TASA; }
    let vueltoC = totalPagadoC - total;
    if (vueltoC < 0) { $('#vueltoCordobas').val('C$ 0.00'); $('#vueltoDolares').val('$ 0.00'); return; }
    let vueltoD = vueltoC / TASA;

    $('#vueltoCordobas').val('C$ ' + vueltoC.toFixed(2));
    $('#vueltoDolares').val('$ ' + vueltoD.toFixed(2));
}

/*  ╔════════ Evento Pago en Córdobas ═════════╗ 
    ╚══════════════════════════════════════════╝ */

$('#pagoCordobas').on('input', function () {

    if (bloqueando) return; bloqueando = true;
    ultimaMoneda = 'C';
    let valor = parseFloat($(this).val()) || 0;
    let enDolares = valor / TASA;
    $('#pagoDolares').val(enDolares.toFixed(2));
    calcularVueltos();
    bloqueando = false;

});

/*  ╔════════ Evento Pago en Dólares ═════════╗ 
    ╚═════════════════════════════════════════╝ */

$('#pagoDolares').on('input', function () {

    if (bloqueando) return;bloqueando = true;
    ultimaMoneda = 'D';
    let valor = parseFloat($(this).val()) || 0;
    let enCordobas = valor * TASA;
    $('#pagoCordobas').val(enCordobas.toFixed(2));
    calcularVueltos();
    bloqueando = false;

});

    
