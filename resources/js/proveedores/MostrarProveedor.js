$(document).ready(function () {

    $.fn.dataTable.ext.search.push( // Check de proveedores inactivos
        function(settings, data, dataIndex) {
            const ocultar = $('#toggleInactivosProveedores').is(':checked');
            if (!ocultar) return true;

            const estado = data[6]; // columna estado_proveedor
            return estado.includes('Activo');
        }
    );

    $('#toggleInactivosProveedores').on('change', function() {
        tabla.draw();
    });

    // Inicializar DataTable
    const tabla = $('#tablaProveedores').DataTable({
        processing: true,
        ajax: {
            url: '/proveedores/mostrar',
            type: 'GET',
            dataSrc: 'proveedores'
        },
        columns: [
            { data: 'nombre_proveedor' },
            { data: 'ruc_proveedor' },
            { data: 'telefono_proveedor' },
            { data: 'correo_proveedor' },
            { data: 'direccion_proveedor' },
            { data: 'fecha_creacion_proveedor' },

            {
                data: 'estado_proveedor',
                render: function(data){
                    return data == 1
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },

            {
                data: 'id_proveedor',
                orderable: false,
                searchable: false,
                render: function(data, type, row){

                    let botonEstado = row.estado_proveedor == 1
                        ? `<button class="btn-baja bajaProveedor" data-id="${data}">Dar Baja</button>`
                        : `<button class="btn-baja bajaProveedor" data-id="${data}">Activar</button>`;

                    return `
                        <button class="btn-editar editarProveedor" data-id="${data}">Editar</button>
                        ${botonEstado}
                    `;
                }
            }
        ],

        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "No hay datos disponibles",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            }
        }
    });

    // Click botón editar
    $('#tablaProveedores').on('click', '.editarProveedor', function(){
        const id = $(this).data('id');
        abrirModalEditar(id);
    });

    // Abrir modal editar
    function abrirModalEditar(id) {

        $.get(`/proveedores/${id}/editar`, function(res){

            const proveedor = res.proveedor;

            $('#editar_id_proveedor').val(proveedor.id_proveedor);
            $('#editar_nombre_proveedor').val(proveedor.nombre_proveedor);
            $('#editar_ruc_proveedor').val(proveedor.ruc_proveedor);
            $('#editar_telefono_proveedor').val(proveedor.telefono_proveedor);
            $('#editar_correo_proveedor').val(proveedor.correo_proveedor);
            $('#editar_direccion_proveedor').val(proveedor.direccion_proveedor);
            $('#editar_estado_proveedor').val(proveedor.estado_proveedor);

            if(proveedor.fecha_creacion_proveedor){
                $('#editar_fecha_creacion_proveedor').val(
                    proveedor.fecha_creacion_proveedor.replace(' ', 'T')
                );
            }

            const modal = new bootstrap.Modal(
                document.getElementById("modalEditarProveedor")
            );

            modal.show();

        });

    }

    // Actualizar proveedor
    $('#btnActualizarProveedor').click(function(){

        const id = $('#editar_id_proveedor').val();

        const datos = {

            nombre_proveedor: $('#editar_nombre_proveedor').val().trim(),
            ruc_proveedor: $('#editar_ruc_proveedor').val().trim(),
            telefono_proveedor: $('#editar_telefono_proveedor').val().trim(),
            correo_proveedor: $('#editar_correo_proveedor').val().trim(),
            direccion_proveedor: $('#editar_direccion_proveedor').val().trim(),
            estado_proveedor: $('#editar_estado_proveedor').val(),

            _token: $('meta[name="csrf-token"]').attr('content')
        };

        if(datos.nombre_proveedor === ''){
            mostrarToast('El nombre del proveedor es obligatorio', 'danger');
            return;
        }

        $.ajax({

            url: `/proveedores/${id}/actualizar/`,
            type: 'PUT',
            data: datos,

            success: function(res){

                mostrarToast('Proveedor actualizado correctamente', 'success');

                tabla.ajax.reload();

                const modalElement = document.getElementById("modalEditarProveedor");
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

});