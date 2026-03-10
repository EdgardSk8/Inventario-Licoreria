$(document).ready(function () {

    // Click en botón Crear Tipo de Gasto
    $('#btnGuardarTipoGasto').click(function() {

        const nombre = $('#crear_nombre_tipo_gasto').val().trim();
        const descripcion = $('#crear_descripcion_tipo_gasto').val().trim();

        if(nombre === '') {
            mostrarToast('El nombre del tipo de gasto es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_tipo_gasto: nombre,
            descripcion_tipo_gasto: descripcion,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '/tipo-gasto/crear',
            type: 'POST',
            data: datos,
            success: function(res){
                mostrarToast('Tipo de gasto creado correctamente', 'success');

                // Limpiar formulario
                $('#formCrearTipoGasto')[0].reset();

                // Cerrar modal
                const modalElement = document.getElementById("modalCrearTipoGasto");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) modalInstance.hide();

                // Recargar DataTable
                if($.fn.DataTable.isDataTable('#tablaTipoGasto')){
                    $('#tablaTipoGasto').DataTable().ajax.reload();
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
    $('#modalCrearTipoGasto').on('hidden.bs.modal', function () {
        $('#formCrearTipoGasto')[0].reset();
    });

});