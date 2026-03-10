$(document).ready(function () {

    // Click en botón Crear Impuesto
    $('#btnGuardarImpuesto').click(function() {

        const nombre = $('#crear_nombre_impuesto').val().trim();
        const porcentaje = $('#crear_porcentaje_impuesto').val().trim();

        if(nombre === '') {
            mostrarToast('El nombre del impuesto es obligatorio', 'danger');
            return;
        }

        if(porcentaje === '') {
            mostrarToast('El porcentaje del impuesto es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_impuesto: nombre,
            porcentaje_impuesto: porcentaje,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({

            url: '/impuestos/crear',
            type: 'POST',
            data: datos,

            success: function(res){

                mostrarToast('Impuesto creado correctamente', 'success');

                // Limpiar formulario
                $('#formCrearImpuesto')[0].reset();

                // Cerrar modal
                const modalElement = document.getElementById("modalCrearImpuesto");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) modalInstance.hide();

                // Recargar DataTable
                if($.fn.DataTable.isDataTable('#tablaImpuestos')){
                    $('#tablaImpuestos').DataTable().ajax.reload();
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
    $('#modalCrearImpuesto').on('hidden.bs.modal', function () {
        $('#formCrearImpuesto')[0].reset();
    });

});