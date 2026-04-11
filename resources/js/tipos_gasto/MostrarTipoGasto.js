$(document).ready(function () {

    document.getElementById('titulo').textContent = 'CLASIFICACION DE GASTOS';

    $.fn.dataTable.ext.search.push( // Check de tipos de gasto inactivos
        function(settings, data, dataIndex) {
            const ocultar = $('#toggleInactivosTipoGasto').is(':checked');
            if (!ocultar) return true; // no filtrar si el checkbox está desmarcado
            const estado = data[2]; // columna "estado_tipo_gasto"
            return estado.includes('Activo'); // solo mostrar activos
        }
    );

    $('#toggleInactivosTipoGasto').on('change', function() { tabla.draw(); });

    // Inicializar DataTable
    const tabla = $('#tablaTipoGasto').DataTable({
        processing: true,
        ajax: {
            url: '/tipo-gasto/mostrar',
            type: 'GET',
            dataSrc: 'tipos_gasto'
        },
        columns: [
            { data: 'nombre_tipo_gasto' },
            { data: 'descripcion_tipo_gasto' },
            { 
                data: 'estado_tipo_gasto',
                render: function(data){
                    return data == 1 
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },
            {
                data: 'id_tipo_gasto',
                orderable: false,
                searchable: false,
                render: function(data, type, row){
                    let botonEstado = row.estado_tipo_gasto == 1 
                        ? `<button class="btn btn-baja bajaTipoGasto" data-id="${data}">
                        
                            <i class="bi bi-person-x"></i> Dar Baja
                        
                        </button>` 

                        : `<button class="btn btn-baja bajaTipoGasto" data-id="${data}">
                        
                            <i class="bi bi-check-circle"></i> Activar
                        
                        </button>`;

                    return `
                        <button class="btn btn-editar editarTipoGasto" data-id="${data}">
                        
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
    $('#tablaTipoGasto').on('click', '.editarTipoGasto', function(){
        const id = $(this).data('id');
        abrirModalEditar(id);
    });

    // Abrir modal y llenar datos
    function abrirModalEditar(id) {
        $.get(`/tipo-gasto/${id}/editar`, function(res){
            const tipo_gasto = res.tipo_gasto;

            $('#editar_id_tipo_gasto').val(tipo_gasto.id_tipo_gasto);
            $('#editar_nombre_tipo_gasto').val(tipo_gasto.nombre_tipo_gasto);
            $('#editar_descripcion_tipo_gasto').val(tipo_gasto.descripcion_tipo_gasto);
            $('#editar_estado_tipo_gasto').val(tipo_gasto.estado_tipo_gasto);

            const modal = new bootstrap.Modal(document.getElementById("modalEditarTipoGasto"));
            modal.show();
        });
    }

    // Actualizar tipo de gasto
    $('#btnActualizarTipoGasto').click(function() {

        const nombre = $('#editar_nombre_tipo_gasto').val().trim();
        const descripcion = $('#editar_descripcion_tipo_gasto').val().trim();
        const estado = $('#editar_estado_tipo_gasto').val();
        const id = $('#editar_id_tipo_gasto').val();

        if(nombre === ''){
            mostrarToast('El nombre del tipo de gasto es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_tipo_gasto: nombre,
            descripcion_tipo_gasto: descripcion,
            estado_tipo_gasto: estado,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: `/tipo-gasto/${id}/actualizar/`,
            type: 'PUT',
            data: datos,
            success: function(res){
                mostrarToast('Tipo de gasto actualizado correctamente', 'success');
                tabla.ajax.reload();

                const modalElement = document.getElementById("modalEditarTipoGasto");
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