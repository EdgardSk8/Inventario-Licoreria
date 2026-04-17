$(document).ready(function () {

    document.getElementById('titulo').textContent = 'REGISTRO DE CUENTAS';

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {

            const ocultar = $('#toggleInactivosCuentas').is(':checked');
            if (!ocultar) return true;

            const estado = data[4]; // columna estado
            return estado.includes('Activo');
        }
    );

    $('#toggleInactivosCuentas').on('change', function() {
        tabla.draw();
    });

    const tabla = $('#tablaCuentas').DataTable({
        autoWidth: false,

        processing: true,
        ajax: {
            url: '/cuenta/mostrar',
            type: 'GET',
            dataSrc: 'cuentas'
        },

        columns: [
            { data: 'nombre_cuenta' },
            { data: 'tipo_cuenta' },
            { data: 'descripcion' },

            {
                data: 'saldo_actual',
                render: function(data){

                    let valor = parseFloat(data);

                    let monto = valor.toLocaleString('es-NI', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    if (valor >= 0) {
                        return `<strong class="text-success">C$ ${monto}</strong>`;
                    } else {
                        return `<strong class="text-danger">C$ ${monto}</strong>`;
                    }
                }
            },

            {
                data: 'estado',
                render: function(data){
                    return data == 1
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },

            {
                data: 'id_cuenta',
                orderable: false,
                searchable: false,
                render: function(data, type, row){

                    let botonEstado = row.estado == 1
                        ? `<button class="btn btn-sm btn-baja bajaCuenta" data-id="${data}">
                            <i class="bi bi-x-circle"></i> Dar Baja
                        </button>`
                        : `<button class="btn btn-sm btn-alta bajaCuenta" data-id="${data}">
                            <i class="bi bi-check-circle"></i> Activar
                        </button>`;

                    // 🔥 Nuevos botones (solo si está activa la cuenta)
                    let botonesSaldo = '';

                    if(row.estado == 1){
                        botonesSaldo = `
                            <button class="btn btn-sm agregar-saldo" data-id="${data}">
                                <i class="bi bi-cash-coin me-1"></i> Agregar
                            </button>

                            <button class="btn btn-sm retirar-saldo" data-id="${data}">
                                <i class="bi bi-dash-circle me-1"></i> Retirar
                            </button>
                        `;
                    }

                    return `
                        <button class="btn btn-sm btn-editar editarCuenta" data-id="${data}">
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        </button>

                        ${botonesSaldo}

                        ${botonEstado}
                    `;
                }
            }
        ],

        lengthMenu: [10, 15, 20, 30, 50, 100],
        ...Traduccion

    });

    // Editar
    $('#tablaCuentas').on('click', '.editarCuenta', function(){
        const id = $(this).data('id');
        abrirModalEditar(id);
    });

    function abrirModalEditar(id) {

        $.get(`/cuenta/${id}/editar`, function(res){

            const cuenta = res.cuenta;

            $('#editar_id_cuenta').val(cuenta.id_cuenta);
            $('#editar_nombre_cuenta').val(cuenta.nombre_cuenta);
            $('#editar_tipo_cuenta').val(cuenta.tipo_cuenta);
            $('#editar_descripcion_cuenta').val(cuenta.descripcion);
            $('#editar_saldo_cuenta').val(cuenta.saldo_actual);
            $('#editar_estado_cuenta').val(cuenta.estado);

            const modal = new bootstrap.Modal(
                document.getElementById("modalEditarCuenta")
            );

            modal.show();
        });
    }

    // Actualizar
    $('#btnActualizarCuenta').click(function(){

        const id = $('#editar_id_cuenta').val();

        const datos = {

            nombre_cuenta: $('#editar_nombre_cuenta').val().trim(),
            tipo_cuenta: $('#editar_tipo_cuenta').val().trim(),
            descripcion: $('#editar_descripcion_cuenta').val().trim(),
            saldo_actual: $('#editar_saldo_cuenta').val(),
            estado: $('#editar_estado_cuenta').val(),

            _token: $('meta[name="csrf-token"]').attr('content')
        };

        if(datos.nombre_cuenta === ''){
            mostrarToast('El nombre de la cuenta es obligatorio', 'danger');
            return;
        }

        if(datos.tipo_cuenta === ''){
            mostrarToast('El tipo de cuenta es obligatorio', 'danger');
            return;
        }

        if(datos.saldo_actual === '' || parseFloat(datos.saldo_actual) < 0){
            mostrarToast('El saldo debe ser válido y positivo', 'danger');
            return;
        }

        $.ajax({

            url: `/cuenta/${id}/actualizar`,
            type: 'PUT',
            data: datos,

            success: function(res){

                mostrarToast('Cuenta actualizada correctamente', 'success');

                tabla.ajax.reload();

                const modalElement = document.getElementById("modalEditarCuenta");
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