$(document).ready(function () {

/*  ═════════ Creacion del Modal ══════════  */

    $('body').append(`
        <div class="modal fade" id="modalAbrirCaja" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apertura de Caja</h5>
                    </div>
                    <div class="modal-body">
                        <p>
                            Usuario: <strong id="usuarioNombre"></strong><br>
                            Rol: <strong id="usuarioRol"></strong>
                        </p>
                        <label>Monto de apertura</label>
                        <input type="number" id="montoInicialCaja" placeholder="5000" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" id="confirmarAbrirCaja">Abrir</button>
                    </div>
                </div>
            </div>
        </div>
    `);

    verificarCajaEstado(); //Funcion verificar caja

});

/*  ═════════ Función para habilitar/deshabilitar botones según estado de caja ══════════  */

function verificarCajaEstado() {
    $.get('/caja/verificar', function(res) {

        if (res.usuario) { $('#usuarioNombre').text(res.usuario.nombre); $('#usuarioRol').text(res.usuario.rol); }

        // Abrir/Cerrar botones
        if (res.abierta) { $('#btnAbrirCaja').prop('disabled', true); $('#btnCerrarCaja').prop('disabled', false); } 
        else { $('#btnAbrirCaja').prop('disabled', false); $('#btnCerrarCaja').prop('disabled', true); }

        setFacturacionEstado(res.abierta); // Funcion de habilitar o deshabilitar 
    });
}

/*  ═════════ Habilitar/deshabilitar inputs y botones de facturación ══════════  */

function setFacturacionEstado(habilitado = true) {
    $('#pagoCordobas, #vueltoCordobas, #vueltoDolares, #pagoDolares, #clientes, #btnFacturar').prop('disabled', !habilitado);
    $('#tablaProductos tbody button, #carrito button').prop('disabled', !habilitado);
    $('#carrito input').prop('readonly', !habilitado);
}


/*  ═════════ Abrir Caja ══════════  */

$(document).on('click', '#btnAbrirCaja', function () { $('#modalAbrirCaja').modal('show'); });

$(document).on('click', '#confirmarAbrirCaja', function () {

    let monto = $('#montoInicialCaja').val();

    if (!monto || monto <= 0) { mostrarToast('Ingrese un monto válido', 'danger'); return; }

    $.post('/caja/abrir', {
        monto_inicial: monto,
        _token: $('meta[name="csrf-token"]').attr('content')
    })
    .done(function(res) {
        $('#modalAbrirCaja').modal('hide');
        verificarCajaEstado();
        mostrarToast(res.mensaje || 'Caja abierta correctamente', 'success');
    })
    .fail(function(xhr) {

        let mensaje = 'Error al abrir caja';

        if (xhr.responseJSON) {

            if (xhr.responseJSON.mensaje) mensaje = xhr.responseJSON.mensaje;
            if (xhr.responseJSON.errors) mensaje = Object.values(xhr.responseJSON.errors).flat().join('<br>');

        }

        mostrarToast(mensaje, 'danger');

    });
});

/*  ═════════ Cerrar Caja ══════════  */

$(document).on('click', '#btnCerrarCaja', function () {

    $.post('/caja/cerrar', {
        _token: $('meta[name="csrf-token"]').attr('content')
    })
    .done(function(res) {
        verificarCajaEstado();
        mostrarToast(res.mensaje || 'Caja cerrada correctamente', 'success');
    })
    .fail(function(xhr) {

        let mensaje = 'Error al cerrar caja';

        if (xhr.responseJSON) {

            if (xhr.responseJSON.mensaje) mensaje = xhr.responseJSON.mensaje;
            if (xhr.responseJSON.errors) mensaje = Object.values(xhr.responseJSON.errors).flat().join('<br>');

        }

        mostrarToast(mensaje, 'danger');

    });
});