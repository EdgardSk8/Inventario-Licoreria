$(document).ready(function () {
    inicializarEventos();
});

/* ═════════ Funcion de Inicializacion ═════════ */

function inicializarEventos() {
    $('#btnGuardarCuenta').click(GuardarCuenta);
    $('#modalCrearCuenta').on('hidden.bs.modal', limpiarFormulario);
}

/* ═════════ Funcion Retorno de llamada (Callback) ═════════ */

function GuardarCuenta() {
    const datosForm = ObtenerDatos();
    const error = Validacion(datosForm);
    if (error) { mostrarToast(error, 'danger'); return; }
    const datos = construirPayload(datosForm);
    const btn = $(this);
    toggleBoton(btn, true);
    CrearCuenta(datos).done(function () {CrearCuentaExitosamente();}).fail(function (err) {manejarError(err);}).always(function () {toggleBoton(btn, false); });
}

/* ═════════ Funcion Extractora de datos ═════════ */

function ObtenerDatos() {

    const saldoInput = $('#crear_saldo_cuenta').val().trim();
    const saldo = saldoInput === '' ? 0 : Number(saldoInput);

    return {
        nombre: $('#crear_nombre_cuenta').val().trim(),
        tipo: $('#crear_tipo_cuenta').val().trim(),
        descripcion: $('#crear_descripcion_cuenta').val().trim(),
        saldo: saldo
    };
}

/* ═════════ Funcion Validacion ═════════ */

function Validacion({ nombre, tipo }) {

    if (nombre === '') return 'El nombre de la cuenta es obligatorio';
    if (tipo === '') return 'El tipo de cuenta es obligatorio';
    return null;
}

/* ═════════ Funcion Constructora ═════════ */

function construirPayload({ nombre, tipo, descripcion, saldo }) {
    return {
        nombre_cuenta: nombre,
        tipo_cuenta: tipo,
        descripcion: descripcion,
        saldo_actual: saldo,
        _token: $('meta[name="csrf-token"]').attr('content')
    };
}

/* ═════════ Funcion de Acceso API ═════════ */

function CrearCuenta(datos) { return $.ajax({ url: '/cuenta/crear', type: 'POST', data: datos }); }

/* ═════════ Funcion Callback Exitosa ═════════ */

function CrearCuentaExitosamente() {
    mostrarToast('Cuenta creada correctamente', 'success');
    limpiarFormulario();
    cerrarModal();
    recargarTabla();
}

/* ═════════ Funcion Utilitaria ═════════ */

function limpiarFormulario() { $('#formCrearCuenta')[0].reset(); }
function toggleBoton(btn, estado) { btn.prop('disabled', estado); }

/* ═════════ Función utilitaria de UI (DOM) ═════════ */

function cerrarModal() {
    const modalElement = document.getElementById("modalCrearCuenta");
    const modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (modalInstance) modalInstance.hide();
}

/* ═════════ Función utilitaria de UI (DATOS) ═════════ */

function recargarTabla() { if ($.fn.DataTable.isDataTable('#tablaCuentas')) { $('#tablaCuentas').DataTable().ajax.reload(); } }

/* ═════════ Función de manejo de errores═════════ */

function manejarError(err) {

    console.error(err);

    if (err.status === 422) {
        const errores = err.responseJSON.errors;
        const mensaje = Object.values(errores)[0][0];
        mostrarToast(mensaje, 'danger');
    }
    else if (err.responseJSON && err.responseJSON.mensaje) { mostrarToast(err.responseJSON.mensaje, 'danger'); }
    else { mostrarToast('Error inesperado del servidor', 'danger'); }
    
}