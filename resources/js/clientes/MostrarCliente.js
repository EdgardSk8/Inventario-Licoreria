$(document).ready(function () {

    document.getElementById('titulo').textContent = 'GESTION DE CLIENTES';

    // Filtro para ocultar clientes inactivos
    $.fn.dataTable.ext.search.push(

        function(settings, data, dataIndex) {
            const ocultar = $('#toggleInactivosClientes').is(':checked');
            if (!ocultar) return true;
            const estado = data[5]; // columna estado_cliente
            return estado.includes('Activo');
        }
        
    );

    $('#toggleInactivosClientes').on('change', function() { tabla.draw(); });

    // Inicializar DataTable
    const tabla = $('#tablaClientes').DataTable({

        processing: true,

        ajax: {url: '/clientes/mostrar', type: 'GET', dataSrc: 'clientes'},

        columns: [

            { data: 'nombre_cliente' },
            { data: 'cedula_cliente' },
            { data: 'ruc_cliente' },
            { data: 'telefono_cliente' },
            { data: 'correo_cliente' },

            { data: 'estado_cliente', render: function(data) { return data == 1
                    ? '<span class="estado estado-activo">Activo</span>'
                    : '<span class="estado estado-inactivo">Inactivo</span>'; } },

            { data: 'id_cliente', orderable: false, searchable: false,
                
                render: function(data, type, row){

                    let botonEstado = row.estado_cliente == 1
                        ? `<button class="btn btn-baja bajaCliente" data-id="${data}">

                                <i class="bi bi-person-x"></i> Dar Baja

                            </button>`

                        : `<button class="btn btn-alta bajaCliente" data-id="${data}">

                                <i class="bi bi-check-circle"></i> Activar

                            </button>`;
                    return `
                        <button class="btn btn-editar editarCliente" data-id="${data}">
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        </button>
                        ${botonEstado}
                    `;

                }
            }

        ],
        ...Traduccion // Constante de traduccion de datatables
    });

    // Click botón editar
    $('#tablaClientes').on('click', '.editarCliente', function(){const id = $(this).data('id');abrirModalEditar(id);});

    // Abrir modal editar cliente
    function abrirModalEditar(id) {

        $.get(`/clientes/${id}/editar`, function(res){

            const cliente = res.cliente;

            $('#editar_id_cliente').val(cliente.id_cliente);
            $('#editar_nombre_cliente').val(cliente.nombre_cliente);
            $('#editar_cedula_cliente').val(cliente.cedula_cliente);
            $('#editar_ruc_cliente').val(cliente.ruc_cliente);
            $('#editar_telefono_cliente').val(cliente.telefono_cliente);
            $('#editar_correo_cliente').val(cliente.correo_cliente);
            $('#editar_direccion_cliente').val(cliente.direccion_cliente);
            $('#editar_estado_cliente').val(cliente.estado_cliente);

            // convertir fecha para datetime-local
            if(cliente.fecha_creacion_cliente){
                let fecha = cliente.fecha_creacion_cliente.replace(' ', 'T').substring(0,16);
                $('#editar_fecha_creacion_cliente').val(fecha);
            }

            const modal = new bootstrap.Modal(document.getElementById("modalEditarCliente"));
            modal.show();

        });

    }



    // Actualizar cliente
    $('#btnActualizarCliente').click(function() {

        const id = $('#editar_id_cliente').val();

        const datos = {

            nombre_cliente: $('#editar_nombre_cliente').val().trim(),
            cedula_cliente: $('#editar_cedula_cliente').val().trim(),
            ruc_cliente: $('#editar_ruc_cliente').val().trim(),
            telefono_cliente: $('#editar_telefono_cliente').val().trim(),
            correo_cliente: $('#editar_correo_cliente').val().trim(),
            direccion_cliente: $('#editar_direccion_cliente').val().trim(),
            estado_cliente: $('#editar_estado_cliente').val(),

            _token: $('meta[name="csrf-token"]').attr('content')

        };


        if(datos.nombre_cliente === ''){ mostrarToast('El nombre del cliente es obligatorio', 'danger'); return;}

        $.ajax({

            url: `/clientes/${id}/actualizar`,
            type: 'PUT',
            data: datos,

            success: function(res){

                mostrarToast('Cliente actualizado correctamente', 'success');

                tabla.ajax.reload();

                const modalElement = document.getElementById("modalEditarCliente");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();

            },

            error: function(err){

                console.error(err);

                if(err.status === 422){
                    const errores = err.responseJSON.errors;
                    let mensaje = '';
                    for(let campo in errores) {mensaje = errores[campo][0]; break; }
                    mostrarToast(mensaje, 'danger');
                }

                else if(err.responseJSON && err.responseJSON.mensaje){ mostrarToast(err.responseJSON.mensaje, 'danger');}
                else{ mostrarToast('Error inesperado del servidor', 'danger'); }

            }

        });

    });

});