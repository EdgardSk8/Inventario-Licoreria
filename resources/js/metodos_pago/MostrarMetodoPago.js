$(document).ready(function () {

    $.fn.dataTable.ext.search.push( // Check de métodos de pago inactivos
        function(settings, data, dataIndex) {
            const ocultar = $('#toggleInactivosMetodosPago').is(':checked');
            if (!ocultar) return true;
            const estado = data[2]; // columna estado_metodo_pago
            return estado.includes('Activo');
        }
    );

    $('#toggleInactivosMetodosPago').on('change', function() { tabla.draw(); });

    // Inicializar DataTable
    const tabla = $('#tablaMetodosPago').DataTable({
        processing: true,
        ajax: {
            url: '/metodos-pago/mostrar',
            type: 'GET',
            dataSrc: 'metodos_pago'
        },
        columns: [
            { data: 'nombre_metodo_pago' },
            { data: 'descripcion_metodo_pago' },
            { 
                data: 'estado_metodo_pago',
                render: function(data){
                    return data == 1 
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },
            {
                data: 'id_metodo_pago',
                orderable: false,
                searchable: false,
                render: function(data, type, row){

                    let botonEstado = row.estado_metodo_pago == 1 
                        ? `<button class="btn-baja bajaMetodoPago" data-id="${data}">Dar Baja</button>` 
                        : `<button class="btn-baja bajaMetodoPago" data-id="${data}">Activar</button>`;

                    return `
                        <button class="btn-editar editarMetodoPago" data-id="${data}">Editar</button>
                        ${botonEstado}
                    `;
                }
            }
        ],
        ...Traduccion // Constante de traduccion de datatables
    });

    // Click en botón Editar
    $('#tablaMetodosPago').on('click', '.editarMetodoPago', function(){
        const id = $(this).data('id');
        abrirModalEditar(id);
    });

    // Abrir modal y llenar datos
    function abrirModalEditar(id) {
        $.get(`/metodos-pago/${id}/editar`, function(res){

            const metodo = res.metodo_pago;

            $('#editar_id_metodo_pago').val(metodo.id_metodo_pago);
            $('#editar_nombre_metodo_pago').val(metodo.nombre_metodo_pago);
            $('#editar_descripcion_metodo_pago').val(metodo.descripcion_metodo_pago);
            $('#editar_estado_metodo_pago').val(metodo.estado_metodo_pago);

            const modal = new bootstrap.Modal(document.getElementById("modalEditarMetodoPago"));
            modal.show();
        });
    }

    // Actualizar método de pago
    $('#btnActualizarMetodoPago').click(function() {

        const nombre = $('#editar_nombre_metodo_pago').val().trim();
        const descripcion = $('#editar_descripcion_metodo_pago').val().trim();
        const estado = $('#editar_estado_metodo_pago').val();
        const id = $('#editar_id_metodo_pago').val();

        if(nombre === ''){
            mostrarToast('El nombre del método de pago es obligatorio', 'danger');
            return;
        }

        const datos = {
            nombre_metodo_pago: nombre,
            descripcion_metodo_pago: descripcion,
            estado_metodo_pago: estado,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: `/metodos-pago/${id}/actualizar`,
            type: 'PUT',
            data: datos,
            success: function(res){

                mostrarToast('Método de pago actualizado correctamente', 'success');

                tabla.ajax.reload();

                const modalElement = document.getElementById("modalEditarMetodoPago");
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