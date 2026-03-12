$(document).ready(function () {

    const inputRUC = $('#crear_ruc_proveedor');
    const selectorTipo = $('#tipo_ruc');

    // Habilitar RUC al seleccionar tipo
    selectorTipo.change(function(){

        const tipo = $(this).val();

        if(tipo === ""){
            inputRUC.prop('disabled', true);
            inputRUC.val('');
            return;
        }

        inputRUC.prop('disabled', false);
        inputRUC.val('');

        // Prefijo automático
        if(tipo === "N" || tipo === "R" || tipo === "E" || tipo === "J"){
            inputRUC.val(tipo);
        }

    });


    // Click en botón Crear Proveedor
    $('#btnGuardarProveedor').click(function() {

        const tipo = $('#tipo_ruc').val();
        const nombre = $('#crear_nombre_proveedor').val().trim();
        const ruc = $('#crear_ruc_proveedor').val().trim().toUpperCase();
        const telefono = $('#crear_telefono_proveedor').val().trim();
        const correo = $('#crear_correo_proveedor').val().trim();
        const direccion = $('#crear_direccion_proveedor').val().trim();

        if(nombre === '') {
            mostrarToast('El nombre del proveedor es obligatorio', 'danger');
            return;
        }

        // Validar que seleccionó tipo
        if(tipo === "" || tipo === null){
            mostrarToast('Seleccione el tipo de proveedor', 'danger');
            return;
        }

        if(!/^[0-9+()]+$/.test(telefono)){
            mostrarToast('El teléfono solo puede contener números y los símbolos + ( )', 'danger');
            return false;
        }

        // evitar doble +
        if((telefono.match(/\+/g) || []).length > 1){
            mostrarToast('El signo + solo puede aparecer una vez', 'danger');
            return false;
        }

        // evitar más de un (
        if((telefono.match(/\(/g) || []).length > 1){
            mostrarToast('Solo se permite un paréntesis de apertura', 'danger');
            return false;
        }

        // evitar más de un )
        if((telefono.match(/\)/g) || []).length > 1){
            mostrarToast('Solo se permite un paréntesis de cierre', 'danger');
            return false;
        }

        // evitar parentesis mal ordenados
        if(telefono.indexOf(')') < telefono.indexOf('(')){
            mostrarToast('Los paréntesis están en orden incorrecto', 'danger');
            return false;
        }

        // Validación del RUC
        if(ruc !== ''){

            if(ruc.length < 14){
                mostrarToast('El RUC debe tener al menos 14 caracteres', 'danger');
                return false;
            }

            if(tipo === "natural"){
                if(!/^[0-9]{13}[A-Z]$/.test(ruc)){
                    mostrarToast('El RUC natural debe tener 13 números y una letra final', 'danger');
                    return;
                }
            }

            if(tipo === "N"){
                if(!/^N[0-9]{13}$/.test(ruc)){
                    mostrarToast('El RUC debe iniciar con N', 'danger');
                    return;
                }
            }

            if(tipo === "R"){
                if(!/^R[0-9]{13}$/.test(ruc)){
                    mostrarToast('El RUC debe iniciar con R', 'danger');
                    return;
                }
            }

            if(tipo === "E"){
                if(!/^E[0-9]{13}$/.test(ruc)){
                    mostrarToast('El RUC debe iniciar con E', 'danger');
                    return;
                }
            }

            if(tipo === "J"){
                if(!/^J[0-9]{13}$/.test(ruc)){
                    mostrarToast('El RUC debe iniciar con J', 'danger');
                    return;
                }
            }

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

                inputRUC.prop('disabled', true);

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
        inputRUC.prop('disabled', true);

    });

});