$(document).ready(function () {

    document.getElementById('titulo').textContent = 'GESTION DE ROLES';

    $.fn.dataTable.ext.search.push( // Check de roles inactivos

        function(settings, data, dataIndex) {

            const ocultar = $('#toggleInactivosRoles').is(':checked');
            if (!ocultar) return true; 
            const estado = data[3]; // columna "estado_rol" (índice 2)
            return estado.includes('Activo'); 

        }

    );

    $('#toggleInactivosRoles').on('change', function() { tabla.draw(); });
    
    const tabla = $('#tablaRoles').DataTable({ // Inicializar DataTable
        processing: true,
        ajax: {
            url: '/roles/mostrar',
            type: 'GET',
            dataSrc: 'roles'
        },
        columns: [
            { data: 'nombre_rol' },
            { data: 'descripcion_rol' },
            { data: 'fecha_creacion_rol', render: function(data){ return formatearFecha(data); }
            },

            { 
                data: 'estado_rol',
                render: function(data){
                    return data == 1 
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },

            {
                data: 'id_rol',
                orderable: false,
                searchable: false,
                render: function(data, type, row){
                    let botonEstado = row.estado_rol == 1 
                        ? `<button class="btn btn btn-baja bajaRol" data-id="${data}">
                        
                            <i class="bi bi-person-x"></i> Dar Baja
                        
                        </button>` 

                        : `<button class="btn btn-baja bajaRol" data-id="${data}">
                        
                            <i class="bi bi-check-circle"></i> Activar
                        
                        </button>`;

                    return `

                        <button class="btn btn-editar editarRol" data-id="${data}">
                        
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
    $('#tablaRoles').on('click', '.editarRol', function(){
        const id = $(this).data('id');
        abrirModalEditar(id);
    });

    // Abrir modal y llenar datos
    function abrirModalEditar(id) {

        $.get(`/roles/${id}/editar`, function(res){

            const rol = res.rol;

            $('#editar_id_rol').val(rol.id_rol);
            $('#editar_nombre_rol').val(rol.nombre_rol);
            $('#editar_descripcion_rol').val(rol.descripcion_rol);
            $('#editar_estado_rol').val(rol.estado_rol);
            $('#editar_fecha_creacion_rol').val(rol.fecha_creacion_rol);

            const modal = new bootstrap.Modal(document.getElementById("modalEditarRol"));
            modal.show();

        });
    }

    // Actualizar rol
    $('#btnActualizarRol').click(function() {
        const nombre = $('#editar_nombre_rol').val().trim();
        const descripcion = $('#editar_descripcion_rol').val().trim();
        const estado = $('#editar_estado_rol').val();
        const id = $('#editar_id_rol').val();

        if(nombre === ''){ mostrarToast('El nombre del rol es obligatorio', 'danger'); return; }

        const datos = {
            nombre_rol: nombre,
            descripcion_rol: descripcion,
            estado_rol: estado,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: `/roles/${id}/actualizar/`,
            type: 'PUT',
            data: datos,
            success: function(res){
                mostrarToast('Rol actualizado correctamente', 'success');
                tabla.ajax.reload();
                const modalElement = document.getElementById("modalEditarRol");
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
                else { mostrarToast('Error inesperado del servidor', 'danger'); }
            }

        });

    });


});