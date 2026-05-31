$(document).ready(function () {

    document.getElementById('titulo').textContent = 'GESTION DE IMPUESTOS';

    $.fn.dataTable.ext.search.push( // Check de impuestos inactivos
        function(settings, data, dataIndex) {
            const ocultar = $('#toggleInactivosImpuestos').is(':checked');
            if (!ocultar) return true;
            const estado = data[3]; // columna estado
            return estado.includes('Activo');
        }
    );

    $('#toggleInactivosImpuestos').on('change', function() { tabla.draw(); });

    // Inicializar DataTable
    const tabla = $('#tablaImpuestos').DataTable({
        processing: true,
        ajax: {
            url: '/impuestos/mostrar',
            type: 'GET',
            dataSrc: 'impuestos'
        },
        columns: [
            { data: 'nombre_impuesto' },

            { 
                data: 'porcentaje_impuesto',
                render: function(data){
                    return data + ' %';
                }
            },

            {
                data: 'fecha_creacion_impuesto',
                render: function (data, type, row) {
                    return formatearFechaDia(data);
                }
            },
                

            { 
                data: 'estado_impuesto',
                render: function(data){
                    return data == 1 
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },

            {
                data: 'id_impuesto',
                orderable: false,
                searchable: false,
                render: function(data, type, row){

                    let botonEstado = row.estado_impuesto == 1 
                        ? `<button class="btn btn-baja bajaImpuesto" data-id="${data}">
                        
                            <i class="bi bi-person-x"></i> Dar Baja
                        
                        </button>` 

                        : `<button class="btn btn-baja bajaImpuesto" data-id="${data}">
                        
                            <i class="bi bi-check-circle"></i> Activar
                        
                        </button>`;

                    return `
                        <button class="btn btn-editar editarImpuesto" data-id="${data}">
                        
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        
                        </button>

                        ${botonEstado}
                    `;
                }
            }
        ],

        columnDefs: [
            // Configurar visibilidad inicial según checkboxes
            { targets: 0, visible: $('.toggle-col[data-column="0"]').is(':checked') },
            { targets: 1, visible: $('.toggle-col[data-column="1"]').is(':checked') },
            { targets: 2, visible: $('.toggle-col[data-column="2"]').is(':checked') },
            { targets: 3, visible: $('.toggle-col[data-column="3"]').is(':checked') },
            { targets: 4, visible: $('.toggle-col[data-column="4"]').is(':checked') },
        ],

       
    });

    $('.toggle-col').on('change', function(e) {
        const column = $('#tablaImpuestos').DataTable().column($(this).attr('data-column'));
        column.visible(this.checked);
    });


    // Click en botón Editar
    $('#tablaImpuestos').on('click', '.editarImpuesto', function(){
        const id = $(this).data('id');
        abrirModalEditar(id);
    });


    // Abrir modal y llenar datos
    function abrirModalEditar(id) {

        $.get(`/impuestos/${id}/editar`, function(res){

            const impuesto = res.impuesto;

            $('#editar_id_impuesto').val(impuesto.id_impuesto);
            $('#editar_nombre_impuesto').val(impuesto.nombre_impuesto);
            $('#editar_porcentaje_impuesto').val(impuesto.porcentaje_impuesto);
            $('#editar_estado_impuesto').val(impuesto.estado_impuesto);

            // convertir fecha para datetime-local
            const fecha = impuesto.fecha_creacion_impuesto
                ? impuesto.fecha_creacion_impuesto.replace(" ", "T").substring(0,16)
                : '';

            $('#editar_fecha_creacion_impuesto').val(fecha);

            const modal = new bootstrap.Modal(document.getElementById("modalEditarImpuesto"));
            modal.show();

        });

    }


    // Actualizar impuesto
    $('#btnActualizarImpuesto').click(function() {

        const nombre = $('#editar_nombre_impuesto').val().trim();
        const porcentaje = $('#editar_porcentaje_impuesto').val();
        const estado = $('#editar_estado_impuesto').val();
        const id = $('#editar_id_impuesto').val();

        if(nombre === ''){
            mostrarToast('El nombre del impuesto es obligatorio', 'danger');
            return;
        }

        if(porcentaje === ''){
            mostrarToast('El porcentaje es obligatorio', 'danger');
            return;
        }

        const datos = {

            nombre_impuesto: nombre,
            porcentaje_impuesto: porcentaje,
            estado_impuesto: estado,
            _token: $('meta[name="csrf-token"]').attr('content')

        };

        $.ajax({

            url: `/impuestos/${id}/actualizar/`,
            type: 'PUT',
            data: datos,

            success: function(res){

                mostrarToast('Impuesto actualizado correctamente', 'success');

                tabla.ajax.reload();

                const modalElement = document.getElementById("modalEditarImpuesto");
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