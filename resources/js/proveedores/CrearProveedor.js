$(document).ready(function () {

    // Click en botón Crear Proveedor
    $('#btnGuardarProveedor').click(function() {

        const nombre = $('#crear_nombre_proveedor').val().trim();
        const ruc = $('#crear_ruc_proveedor').val().trim();
        const telefono = $('#crear_telefono_proveedor').val().trim();
        const correo = $('#crear_correo_proveedor').val().trim();
        const direccion = $('#crear_direccion_proveedor').val().trim();

        if(nombre === '') {
            mostrarToast('El nombre del proveedor es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_proveedor: nombre,
            ruc_proveedor: ruc,
            telefono_proveedor: telefono,
            correo_proveedor: correo,
            direccion_proveedor: direccion,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '/proveedores/crear',
            type: 'POST',
            data: datos,
            success: function(res){

                mostrarToast('Proveedor creado correctamente', 'success');

                // Limpiar formulario
                $('#formCrearProveedor')[0].reset();

                // Cerrar modal
                const modalElement = document.getElementById("modalCrearProveedor");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) modalInstance.hide();

                // Recargar DataTable
                if($.fn.DataTable.isDataTable('#tablaProveedores')){
                    $('#tablaProveedores').DataTable().ajax.reload();
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
    $('#modalCrearProveedor').on('hidden.bs.modal', function () {
        $('#formCrearProveedor')[0].reset();
    });

});