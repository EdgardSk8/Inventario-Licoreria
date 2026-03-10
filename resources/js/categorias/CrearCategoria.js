$(document).ready(function () {

    // Click en botón Crear Categoria
    $('#btnGuardarCategoria').click(function() {

        const nombre = $('#crear_nombre_categoria').val().trim();
        const descripcion = $('#crear_descripcion_categoria').val().trim();

        if(nombre === '') {
            mostrarToast('El nombre de la categoría es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_categoria: nombre,
            descripcion_categoria: descripcion,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '/categorias/crear',
            type: 'POST',
            data: datos,
            success: function(res){

                mostrarToast('Categoría creada correctamente', 'success');

                // Limpiar formulario
                $('#formCrearCategoria')[0].reset();

                // Cerrar modal
                const modalElement = document.getElementById("modalCrearCategoria");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) modalInstance.hide();

                // Recargar DataTable
                if($.fn.DataTable.isDataTable('#tablaCategorias')){
                    $('#tablaCategorias').DataTable().ajax.reload();
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
    $('#modalCrearCategoria').on('hidden.bs.modal', function () {
        $('#formCrearCategoria')[0].reset();
    });

});