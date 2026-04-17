$(document).ready(function () {

    // Click en botón Crear Cuenta
    $('#btnGuardarCuenta').click(function () {

        const nombre = $('#crear_nombre_cuenta').val().trim();
        const tipo = $('#crear_tipo_cuenta').val().trim();
        const descripcion = $('#crear_descripcion_cuenta').val().trim();
        const saldo = $('#crear_saldo_cuenta').val();

        if (nombre === '') {
            mostrarToast('El nombre de la cuenta es obligatorio', 'danger');
            return;
        }

        if (tipo === '') {
            mostrarToast('El tipo de cuenta es obligatorio', 'danger');
            return;
        }

        if (saldo === '' || isNaN(saldo) || parseFloat(saldo) < 0) {
            mostrarToast('El saldo debe ser válido y positivo', 'danger');
            return;
        }

        const datos = {
            nombre_cuenta: nombre,
            tipo_cuenta: tipo,
            descripcion: descripcion,
            saldo_actual: saldo,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        const btn = $(this);
        btn.prop('disabled', true); // evitar doble click

        $.ajax({
            url: '/cuenta/crear',
            type: 'POST',
            data: datos,

            success: function (res) {

                mostrarToast('Cuenta creada correctamente', 'success');

                // Limpiar formulario
                $('#formCrearCuenta')[0].reset();

                // Cerrar modal
                const modalElement = document.getElementById("modalCrearCuenta");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) modalInstance.hide();

                // Recargar DataTable
                if ($.fn.DataTable.isDataTable('#tablaCuentas')) {
                    $('#tablaCuentas').DataTable().ajax.reload();
                }

            },

            error: function (err) {

                console.error(err);

                if (err.status === 422) {

                    const errores = err.responseJSON.errors;
                    let mensaje = '';

                    for (let campo in errores) {
                        mensaje = errores[campo][0];
                        break;
                    }

                    mostrarToast(mensaje, 'danger');

                }
                else if (err.responseJSON && err.responseJSON.mensaje) {

                    mostrarToast(err.responseJSON.mensaje, 'danger');

                }
                else {

                    mostrarToast('Error inesperado del servidor', 'danger');

                }

            },

            complete: function () {
                btn.prop('disabled', false);
            }

        });

    });


    // Limpiar formulario al cerrar modal
    $('#modalCrearCuenta').on('hidden.bs.modal', function () {

        $('#formCrearCuenta')[0].reset();

    });

});