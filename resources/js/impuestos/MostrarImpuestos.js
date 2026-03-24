$(document).ready(function () {

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

            { data: 'fecha_creacion_impuesto' },

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
                        ? `<button class="btn-baja bajaImpuesto" data-id="${data}">Dar Baja</button>` 
                        : `<button class="btn-baja bajaImpuesto" data-id="${data}">Activar</button>`;

                    return `
                        <button class="btn-editar editarImpuesto" data-id="${data}">Editar</button>
                        ${botonEstado}
                    `;
                }
            }
        ],

        ...Traduccion // Constante de traduccion de datatables
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