$(document).ready(function () {

    // Click en botón Crear Rol
    $('#btnGuardarRol').click(function() {

        const nombre = $('#crear_nombre_rol').val().trim();
        const descripcion = $('#crear_descripcion_rol').val().trim();

        if(nombre === '') {
            mostrarToast('El nombre del rol es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_rol: nombre,
            descripcion_rol: descripcion,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '/roles/crear',
            type: 'POST',
            data: datos,
            success: function(res){
                mostrarToast('Rol creado correctamente', 'success');

                // Limpiar formulario
                $('#formCrearRol')[0].reset();

                // Cerrar modal
                const modalElement = document.getElementById("modalCrearRol");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) modalInstance.hide();

                // Recargar DataTable
                if($.fn.DataTable.isDataTable('#tablaRoles')){
                    $('#tablaRoles').DataTable().ajax.reload();
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
    $('#modalCrearRol').on('hidden.bs.modal', function () {
        $('#formCrearRol')[0].reset();
    });

});