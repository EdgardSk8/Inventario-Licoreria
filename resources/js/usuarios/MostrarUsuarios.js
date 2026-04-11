$(document).ready(function () {

    document.getElementById('titulo').textContent = 'GESTION DE USUARIOS';

    $.fn.dataTable.ext.search.push( // Check de usuarios inactivos

    function(settings, data, dataIndex) {

        const ocultar = $('#toggleInactivosUsuarios').is(':checked');
        if (!ocultar) return true; // no filtrar si el checkbox está desmarcado
        const estado = data[4]; // columna "estado_usuario" (índice 4)
        return estado.includes('Activo'); // solo mostrar activos

    }); $('#toggleInactivosUsuarios').on('change', function() { tabla.draw(); });

    // Inicializar DataTable
    const tabla = $('#tablaUsuarios').DataTable({
        processing: true,
        ajax: {
            url: '/usuarios/mostrar',
            type: 'GET',
            dataSrc: 'usuarios'
        },
        columns: [
            { data: 'nombre_completo_usuario' },
            { data: 'cedula_identidad_usuario' },
            { data: 'nombre_usuario' },
            { data: 'nombre_rol' },
            { 
                data: 'estado_usuario',
                render: function(data){
                    return data == 1 
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },
            {
                data: 'id_usuario',
                orderable: false,
                searchable: false,
                render: function(data, type, row){
                    let botonEstado = row.estado_usuario == 1 
                        ? `<button class="btn btn-baja bajaUsuario" data-id="${data}">
                        
                            <i class="bi bi-person-x"></i> Dar Baja
                        
                        </button>` 

                        : `<button class="btn btn-baja bajaUsuario" data-id="${data}">
                        
                            <i class="bi bi-check-circle"></i> Activar
                        
                        </button>`;

                    return `

                        <button class="btn btn-editar editarUsuario" data-id="${data}">
                        
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        
                        </button>
                        
                        ${botonEstado}
                    `;
                }
            }
        ],
        ...Traduccion // Constante de traduccion de datatables
    });

    // Click en botón Editar
    $('#tablaUsuarios').on('click', '.editarUsuario', function(){
        const id = $(this).data('id');
        abrirModalEditar(id);
    });

    // Abrir modal y llenar datos
    function abrirModalEditar(id) {

        $.get(`/usuarios/${id}/editar`, function(res){

            const usuario = res.usuario;

            $('#editar_id_usuario').val(usuario.id_usuario);
            $('#editar_nombre_completo_usuario').val(usuario.nombre_completo_usuario);
            $('#editar_cedula_usuario').val(usuario.cedula_identidad_usuario);
            $('#editar_nombre_usuario').val(usuario.nombre_usuario);
            $('#editar_estado_usuario').val(usuario.estado_usuario);
            $('#editar_fecha_creacion').val(usuario.fecha_creacion_usuario);

            cargarRolesEditar(usuario.id_rol_usuario);

            const modal = new bootstrap.Modal(document.getElementById("modalEditarUsuario"));
            modal.show();

        });

    }
    

    // Cargar roles
    function cargarRolesEditar(rolSeleccionado){

        const select = $('#editar_rol_usuario');

        fetch('/roles-usuario/mostrar?estado=1') // tu endpoint de roles
            .then(response => response.json())
            .then(data => {
                select.empty();
                // Asegurarse que es un array de roles
                const roles = data.data || data.roles || [];
                roles.forEach(rol => {
                    if(rol.estado_rol == 1){ // SOLO roles activos
                        const selected = Number(rol.id_rol) === Number(rolSeleccionado) ? "selected" : "";
                        select.append(`<option value="${rol.id_rol}" ${selected}>${rol.nombre_rol}</option>`);
                    }
                });
            })
            .catch(err => console.error("Error al cargar roles:", err));
    }

    function formatearCedula(inputId) {
        const cedula = document.getElementById(inputId);
        if (!cedula) return;

        cedula.addEventListener("input", function () {
            let valor = this.value.replace(/[^0-9a-zA-Z]/g, "");

            let numeros = valor.slice(0, 13).replace(/[^0-9]/g, "");
            let letra = valor.slice(13, 14).replace(/[^a-zA-Z]/g, "").toUpperCase();

            valor = numeros + letra;

            if (valor.length > 3) valor = valor.slice(0, 3) + "-" + valor.slice(3);
            if (valor.length > 10) valor = valor.slice(0, 10) + "-" + valor.slice(10);

            this.value = valor;
        });
    }

    formatearCedula("editar_cedula_usuario")

    // Actualizar usuario
    $('#btnActualizarUsuario').click(function() {
        
        const nombre = $('#editar_nombre_completo_usuario').val().trim();
        const cedula = $('#editar_cedula_usuario').val().trim();
        const usuario = $('#editar_nombre_usuario').val().trim();
        const rol = $('#editar_rol_usuario').val();
        const estado = $('#editar_estado_usuario').val();
        const password = $('#editar_password_usuario').val().trim();
        const id = $('#editar_id_usuario').val();

        if(nombre === '' || cedula === '' || usuario === '' || !rol){
            mostrarToast('Todos los campos son obligatorios (excepto contraseña)', 'danger');
            return;
        }

        const datos = {
            nombre_completo_usuario: nombre,
            cedula_identidad_usuario: cedula,
            nombre_usuario: usuario,
            id_rol_usuario: rol,
            estado_usuario: estado,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        if(password.length >= 6){
            datos.password_usuario = password;
        }

        $.ajax({
            url: `/usuarios/${id}/actualizar/`,
            type: 'PUT',
            data: datos,
            success: function(res){
                mostrarToast('Usuario actualizado correctamente', 'success');tabla.ajax.reload();
                // Después (BS5)
                const modalElement = document.getElementById("modalEditarUsuario");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
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

    // Recargar tabla al cancelar
    $('#modalEditarUsuario').on('hidden.bs.modal', function () {tabla.ajax.reload(); });

});