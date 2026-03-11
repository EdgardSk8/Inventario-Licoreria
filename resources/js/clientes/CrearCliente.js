$(document).ready(function () {

    // Click en botón Crear Cliente
    $('#btnGuardarCliente').click(function() {

        const nombre = $('#crear_nombre_cliente').val().trim();
        const cedula = $('#crear_cedula_cliente').val().trim();
        const ruc = $('#crear_ruc_cliente').val().trim();
        const telefono = $('#crear_telefono_cliente').val().trim();
        const correo = $('#crear_correo_cliente').val().trim();
        const direccion = $('#crear_direccion_cliente').val().trim();

        if(nombre === '') {
            mostrarToast('El nombre del cliente es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_cliente: nombre,
            cedula_cliente: cedula,
            ruc_cliente: ruc,
            telefono_cliente: telefono,
            correo_cliente: correo,
            direccion_cliente: direccion,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({

            url: '/clientes/crear',
            type: 'POST',
            data: datos,

            success: function(res){

                mostrarToast('Cliente creado correctamente', 'success');

                // Limpiar formulario
                $('#formCrearCliente')[0].reset();

                // Cerrar modal
                const modalElement = document.getElementById("modalCrearCliente");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) modalInstance.hide();

                // Recargar DataTable
                if($.fn.DataTable.isDataTable('#tablaClientes')){
                    $('#tablaClientes').DataTable().ajax.reload();
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
    $('#modalCrearCliente').on('hidden.bs.modal', function () {
        $('#formCrearCliente')[0].reset();
    });

});