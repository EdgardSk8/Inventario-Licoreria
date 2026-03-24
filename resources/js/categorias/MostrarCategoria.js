$(document).ready(function () {

    $.fn.dataTable.ext.search.push( // Check de categorias inactivas
        function(settings, data, dataIndex) {
            const ocultar = $('#toggleInactivosCategorias').is(':checked');
            if (!ocultar) return true;
            const estado = data[3]; // columna estado_categoria
            return estado.includes('Activo');
        }
    );

    $('#toggleInactivosCategorias').on('change', function() { tabla.draw(); });

    // Inicializar DataTable
    const tabla = $('#tablaCategorias').DataTable({
        processing: true,
        ajax: {
            url: '/categorias/mostrar',
            type: 'GET',
            dataSrc: 'categorias'
        },
        columns: [
            { data: 'nombre_categoria' },
            { data: 'descripcion_categoria' },
            { data: 'fecha_creacion_categoria' },
            { 
                data: 'estado_categoria',
                render: function(data){
                    return data == 1 
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },
            {
                data: 'id_categoria',
                orderable: false,
                searchable: false,
                render: function(data, type, row){

                    let botonEstado = row.estado_categoria == 1
                        ? `<button class="btn-baja bajaCategoria" data-id="${data}">Dar Baja</button>`
                        : `<button class="btn-baja bajaCategoria" data-id="${data}">Activar</button>`;

                    return `
                        <button class="btn-editar editarCategoria" data-id="${data}">Editar</button>
                        ${botonEstado}
                    `;
                }
            }
        ],
        ...Traduccion // Constante de traduccion de datatables
    });

    // Click en botón Editar
    $('#tablaCategorias').on('click', '.editarCategoria', function(){
        const id = $(this).data('id');
        abrirModalEditar(id);
    });

    // Abrir modal y llenar datos
    function abrirModalEditar(id) {

        $.get(`/categorias/${id}/editar`, function(res){

            const categoria = res.categoria;

            $('#editar_id_categoria').val(categoria.id_categoria);
            $('#editar_nombre_categoria').val(categoria.nombre_categoria);
            $('#editar_descripcion_categoria').val(categoria.descripcion_categoria);
            $('#editar_estado_categoria').val(categoria.estado_categoria);
            $('#editar_fecha_creacion_categoria').val(categoria.fecha_creacion_categoria);

            const modal = new bootstrap.Modal(document.getElementById("modalEditarCategoria"));
            modal.show();

        });

    }

    // Actualizar categoria
    $('#btnActualizarCategoria').click(function() {

        const nombre = $('#editar_nombre_categoria').val().trim();
        const descripcion = $('#editar_descripcion_categoria').val().trim();
        const estado = $('#editar_estado_categoria').val();
        const id = $('#editar_id_categoria').val();

        if(nombre === ''){
            mostrarToast('El nombre de la categoría es obligatorio', 'danger');
            return;
        }

        const datos = {

            nombre_categoria: nombre,
            descripcion_categoria: descripcion,
            estado_categoria: estado,
            _token: $('meta[name="csrf-token"]').attr('content')

        };

        $.ajax({

            url: `/categorias/${id}/actualizar/`,
            type: 'PUT',
            data: datos,

            success: function(res){

                mostrarToast('Categoría actualizada correctamente', 'success');
                tabla.ajax.reload();

                const modalElement = document.getElementById("modalEditarCategoria");
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