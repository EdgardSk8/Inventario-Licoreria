$(document).ready(function () {

    document.getElementById('titulo').textContent = 'GESTIÓN DE GASTOS';

    /* ═════════════ FILTRO INACTIVOS ═════════════ */

    $.fn.dataTable.ext.search.push(function (settings, data) {

        const ocultar = $('#toggleInactivosGastos').is(':checked');

        if (!ocultar) return true;

        const estado = data[7];

        return estado.includes('Activo');
    });

    $('#toggleInactivosGastos').on('change', function () {
        tabla.draw();
    });

    /* ═════════════ TABLA ═════════════ */

    const tabla = $('#tablaGastos').DataTable({

        processing: true,

        ajax: {
            url: '/gastos/mostrar',
            type: 'GET',
            dataSrc: 'gastos'
        },

        columns: [

            { data: 'nombre_gasto' },
            { data: 'tipo' },
            { data: 'descripcion_gasto' },
            {
                data: 'fecha_pago',
                render: function (data) {
                    return data ? FechaSimple(data) : '-';
                }
            },

            // 🔥 ESTADO DE PAGO (nuevo)
            {
                data: 'estado_pago',
                render: function (data) {

                    const estado = (data || '').toUpperCase();

                    if (estado === 'PAGADO') {
                        return '<span class="estado estado-activo">Pagado</span>';
                    }

                    if (estado === 'ATRASADO') {
                        return '<span class="estado estado-inactivo">Atrasado</span>';
                    }

                    return '<span class="estado estado-pendiente">Sin pagar</span>';
                }
            },

            // 🔹 ÚLTIMA FECHA
            {
                data: 'ultimo_pago_fecha',
                render: function (data) {
                    return data ? formatearFecha(data) : '-';
                }
            },
            // 🔹 ÚLTIMO MONTO
            {
                data: 'ultimo_pago_monto',
                render: function (data) {
                    return data ? '<strong> C$ ' + parseFloat(data).toFixed(2) : '-';
                }
            },

            // 🔹 ESTADO ACTIVO / INACTIVO
            {
                data: 'estado_gasto',
                render: function (data) {
                    return data == 1
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },

            // 🔹 ACCIONES
            {
                data: 'id_gasto',
                orderable: false,
                searchable: false,
                render: function (data) {

                    return `
                        <button class="btn btn-sm btn-editar editarGasto" data-id="${data}">
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        </button>

                        <button class="btn btn-sm btn-detalle detalleGasto" data-id="${data}">
                            <i class="bi bi-eye me-1"></i> Detalles
                        </button>

                        <button class="btn btn-sm pagar-gasto pagarGasto" data-id="${data}">
                            <i class="bi bi-cash-coin me-1"></i> Pagar
                        </button>
                    `;
                }
            }
        ],

        columnDefs: [
            { targets: 0, visible: $('.toggle-col[data-column="0"]').is(':checked') },
            { targets: 1, visible: $('.toggle-col[data-column="1"]').is(':checked') },
            { targets: 2, visible: $('.toggle-col[data-column="2"]').is(':checked') },
            { targets: 3, visible: $('.toggle-col[data-column="3"]').is(':checked') },
            { targets: 4, visible: $('.toggle-col[data-column="4"]').is(':checked') },
            { targets: 5, visible: $('.toggle-col[data-column="5"]').is(':checked') },
            { targets: 6, visible: $('.toggle-col[data-column="6"]').is(':checked') },
            { targets: 7, visible: $('.toggle-col[data-column="7"]').is(':checked') },
            { targets: 8, visible: $('.toggle-col[data-column="8"]').is(':checked') }
        ],

        lengthMenu: [10, 15, 20, 30, 50, 100],
        ...Traduccion
    });

    /* ═════════════ TOGGLE COLUMNAS ═════════════ */

    $('.toggle-col').on('change', function () {

        const column = tabla.column($(this).data('column'));
        column.visible($(this).is(':checked'));

    });

    /* ═════════════ EDITAR GASTO ═════════════ */

    $('#tablaGastos').on('click', '.editarGasto', function () {

        const id = $(this).data('id');
        abrirModalEditarGasto(id);
    });

    function abrirModalEditarGasto(id) {

        $.get(`/gastos/editar/${id}`, function (res) {

            const gasto = res.gasto;

            $('#editar_id_gasto').val(gasto.id_gasto);
            $('#editar_nombre_gasto').val(gasto.nombre_gasto);
            $('#editar_descripcion_gasto').val(gasto.descripcion_gasto);
            $('#editar_estado_gasto').val(gasto.estado_gasto);

            cargarTiposGastoEditar(gasto.id_tipo_gasto);

            new bootstrap.Modal(document.getElementById("modalEditarGasto")).show();

        });
    }

    /* ═════════════ TIPOS GASTO ═════════════ */

    function cargarTiposGastoEditar(seleccionado) {

        const select = $('#editar_id_tipo_gasto');

        fetch('/tipo-gasto/mostrar')
            .then(res => res.json())
            .then(data => {

                select.empty();

                const tipos = data.tipos_gasto || [];

                select.append(`<option disabled selected value="">Seleccione</option>`);

                tipos.forEach(tipo => {

                    select.append(`
                        <option value="${tipo.id_tipo_gasto}" 
                            ${Number(tipo.id_tipo_gasto) === Number(seleccionado) ? "selected" : ""}>
                            ${tipo.nombre_tipo_gasto}
                        </option>
                    `);
                });
            })
            .catch(err => console.error(err));
    }

    /* ═════════════ ACTUALIZAR GASTO ═════════════ */

    $('#btnActualizarGasto').click(function () {

        const id = $('#editar_id_gasto').val();

        const datos = {

            nombre_gasto: $('#editar_nombre_gasto').val().trim(),
            descripcion_gasto: $('#editar_descripcion_gasto').val().trim(),
            id_tipo_gasto: $('#editar_id_tipo_gasto').val(),
            estado_gasto: $('#editar_estado_gasto').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({

            url: `/gastos/actualizar/${id}`,
            type: 'POST',
            data: datos,

            success: function () {

                mostrarToast('Gasto actualizado correctamente', 'success');

                tabla.ajax.reload();

                bootstrap.Modal.getInstance(document.getElementById("modalEditarGasto")).hide();
            },

            error: function (err) {

                if (err.status === 422) {
                    const errores = err.responseJSON.errors;
                    mostrarToast(Object.values(errores)[0][0], 'danger');
                }
                else if (err.responseJSON?.mensaje) {
                    mostrarToast(err.responseJSON.mensaje, 'danger');
                }
                else {
                    mostrarToast('Error inesperado del servidor', 'danger');
                }
            }
        });
    });

    /* ═════════════ RECARGA ═════════════ */

    $('#modalEditarGasto').on('hidden.bs.modal', function () {
        tabla.ajax.reload();
    });

});