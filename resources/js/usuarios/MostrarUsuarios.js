$(document).ready(function () {

    $('#tablaUsuarios').DataTable({

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

                    if(data == 1){
                        return '<span class="estado estado-activo">Activo</span>';
                    } else{
                        return '<span class="estado estado-inactivo">Inactivo</span>';
                    }

                }
            },

            {
                data: 'id_usuario',
                orderable: false,
                searchable: false,

                render: function(data, type, row){

                    let botonEstado = '';

                    if(row.estado_usuario == 1){
                        botonEstado = `<button class="btn-baja bajaUsuario" data-id="${data}" style="background:#dc3545;color:white;">Dar Baja</button>`;
                    }else{
                        botonEstado = `<button class="btn-baja bajaUsuario" data-id="${data}" style="background:#0d6efd;color:white;">Activar</button>`;
                    }

                    return `
                        <button class="btn-editar editarUsuario" data-id="${data}">Editar</button>
                        ${botonEstado}
                    `;

                }
            }
        ],

        language: 
        {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",

            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        }

    });

});