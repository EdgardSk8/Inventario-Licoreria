// ==========================
// CUANDO EL DOM ESTÉ LISTO
// ==========================
$(document).ready(function(){

    // ==========================
    // ABRIR MODAL
    // ==========================
    $('#btnEditar').click(function(){
        const id = $('#editar_id_empresa').val() || 1; // dinámico o fallback
        abrirModalEditarEmpresa(id);
    });

    // ==========================
    // ACTUALIZAR EMPRESA
    // ==========================
    $('#btnActualizarEmpresa').click(function() {

        const id = $('#editar_id_empresa').val();
        const nombre = $('#editar_nombre_empresa').val().trim();

        if(nombre === ''){
            mostrarToast('El nombre es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_empresa: nombre,
            ruc_empresa: $('#editar_ruc_empresa').val(),
            direccion_empresa: $('#editar_direccion_empresa').val(),
            telefono_empresa: $('#editar_telefono_empresa').val(),
            correo_empresa: $('#editar_correo_empresa').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'PUT' // ✅ importante para Laravel
        };

        $.ajax({
            url: `/credenciales/${id}/actualizar`,
            type: 'POST', // ✅ Laravel recomienda POST + _method
            data: datos,

            success: function(res){
                mostrarToast('Datos actualizados correctamente', 'success');

                const empresa = res.credenciales;

                // ==========================
                // ACTUALIZAR VISTA
                // ==========================
                $('#nombre_empresa').text(empresa.nombre_empresa);
                $('#ruc_empresa').text(empresa.ruc_empresa);
                $('#direccion_empresa').text(empresa.direccion_empresa);
                $('#telefono_empresa').text(empresa.telefono_empresa);
                $('#correo_empresa').text(empresa.correo_empresa);

                // ==========================
                // CERRAR MODAL
                // ==========================
                const modalElement = document.getElementById("modalEditarEmpresa");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);

                if(modalInstance){
                    modalInstance.hide();
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

});


// ==========================
// CARGAR DATOS Y ABRIR MODAL
// ==========================
function abrirModalEditarEmpresa(id) {

    $.get(`/credenciales/${id}/editar`, function(res){

        const empresa = res.credenciales;

        // ==========================
        // LLENAR FORMULARIO
        // ==========================
        $('#editar_id_empresa').val(empresa.id);
        $('#editar_nombre_empresa').val(empresa.nombre_empresa);
        $('#editar_ruc_empresa').val(empresa.ruc_empresa);
        $('#editar_direccion_empresa').val(empresa.direccion_empresa);
        $('#editar_telefono_empresa').val(empresa.telefono_empresa);
        $('#editar_correo_empresa').val(empresa.correo_empresa);

        // ==========================
        // ABRIR MODAL
        // ==========================
        const modalElement = document.getElementById("modalEditarEmpresa");

        if(modalElement){
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        } else {
            console.error('No se encontró el modal #modalEditarEmpresa');
        }

    }).fail(function(err){
        console.error(err);
        mostrarToast('Error al cargar los datos', 'danger');
    });
}