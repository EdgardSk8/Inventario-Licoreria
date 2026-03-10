$(document).ready(function () {

    // Click en botón Crear Método de Pago
    $('#btnGuardarMetodoPago').click(function() {

        const nombre = $('#crear_nombre_metodo_pago').val().trim();
        const descripcion = $('#crear_descripcion_metodo_pago').val().trim();

        if(nombre === '') {
            mostrarToast('El nombre del método de pago es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_metodo_pago: nombre,
            descripcion_metodo_pago: descripcion,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '/metodos-pago/crear',
            type: 'POST',
            data: datos,
            success: function(res){

                mostrarToast('Método de pago creado correctamente', 'success');

                // Limpiar formulario
                $('#formCrearMetodoPago')[0].reset();

                // Cerrar modal
                const modalElement = document.getElementById("modalCrearMetodoPago");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) modalInstance.hide();

                // Recargar DataTable
                if($.fn.DataTable.isDataTable('#tablaMetodosPago')){
                    $('#tablaMetodosPago').DataTable().ajax.reload();
                }
            },
            error: function(err){

                console.error(err);

                if(err.status === 422){

                    const errores = err.responseJSON.errors;
                    let mensaje = '';

                    for(let campo in errores){
                        mensaje = errores[campo][0];
                        break;
                    }

                    mostrarToast(mensaje, 'danger');
                } 
                else if(err.responseJSON && err.responseJSON.mensaje){

                    mostrarToast(err.responseJSON.mensaje, 'danger');
                } 
                else {

                    mostrarToast('Error inesperado del servidor', 'danger');
                }
            }
        });

    });

    // Limpiar formulario al cerrar modal
    $('#modalCrearMetodoPago').on('hidden.bs.modal', function () {
        $('#formCrearMetodoPago')[0].reset();
    });

});