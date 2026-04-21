$(document).ready(function () {

    document.getElementById('titulo').textContent = 'REGISTRO DE CUENTAS';
    let tabla;

/* ════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

/* ═════════════ ( FILTRO ACTIVOS / INACTIVOS ) ═════════════ */

    $.fn.dataTable.ext.search.push(function(settings, data) {

        const ocultar = $('#toggleInactivosCuentas').is(':checked');
        if (!ocultar) return true;

        const estado = data[4]; // Columna de estado
        return estado.includes('Activo');
    });

    $('#toggleInactivosCuentas').on('change', function() { tabla.draw(); }); // Redibujar tabla ocultar inactivos


/* ════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

/* ═════════════ ( DATATABLE ) ═════════════ */

    tabla = $('#tablaCuentas').DataTable({

        autoWidth: false, processing: true, order: [[0, 'asc']],
        ajax: { url: '/cuenta/mostrar', type: 'GET', dataSrc: 'cuentas' },

        columns: [

            { data: 'nombre_cuenta' },
            { data: 'tipo_cuenta' },
            { data: 'descripcion' },
            { data: 'saldo_actual', render: renderSaldo },
            { data: 'estado', render: renderEstado },
            { data: 'id_cuenta', render: renderAcciones }

        ], lengthMenu: [10, 15, 20, 30, 50, 100], ...Traduccion

    });

/* ════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

/* ═════════════ ( RENDERERS ) ═════════════ */

    function renderSaldo(data){

        let valor = parseFloat(data);
        let monto = valor.toLocaleString('es-NI', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        return valor >= 0 ? `<strong class="text-success">C$ ${monto}</strong>` : `<strong class="text-danger">C$ ${monto}</strong>`;

    }

/* ═════════════════════════════════════════ */

    function renderEstado(data){
        return data == 1 ? '<span class="estado estado-activo">Activo</span>' : '<span class="estado estado-inactivo">Inactivo</span>';
    }

/* ═════════════════════════════════════════ */

    function renderAcciones(data, type, row){

        let botonEstado = row.estado == 1
            ? `<button class="btn btn-sm btn-baja bajaCuenta" data-id="${data}">
                <i class="bi bi-x-circle"></i> Dar Baja
              </button>`
            : `<button class="btn btn-sm btn-alta bajaCuenta" data-id="${data}">
                <i class="bi bi-check-circle"></i> Activar
              </button>`;
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

    /* ════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

    /* ═════════════ ( EVENTOS TABLA ) ═════════════ */

    $('#tablaCuentas').on('click', '.editarCuenta', function(){
        abrirModalEditar($(this).data('id'));
    });

    $('#tablaCuentas').on('click', '.agregar-saldo', function(){
        const row = tabla.row($(this).closest('tr')).data();
        abrirModalMovimiento(row, 'AGREGAR');
    });

    $('#tablaCuentas').on('click', '.retirar-saldo', function(){
        const row = tabla.row($(this).closest('tr')).data();
        abrirModalMovimiento(row, 'RETIRAR');
    });

/* ════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

/* ═════════════ ( MODAL EDITAR ) ═════════════ */

    function abrirModalEditar(id){

        $.get(`/cuenta/${id}/editar`, function(res){

            const c = res.cuenta;

            $('#editar_id_cuenta').val(c.id_cuenta);
            $('#editar_nombre_cuenta').val(c.nombre_cuenta);
            $('#editar_tipo_cuenta').val(c.tipo_cuenta);
            $('#editar_descripcion_cuenta').val(c.descripcion);
            $('#editar_saldo_cuenta').val(c.saldo_actual);
            $('#editar_estado_cuenta').val(c.estado);

            new bootstrap.Modal('#modalEditarCuenta').show();

        });
    }

/* ═════════════════════════════════════════ */

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

        if(!validarCuenta(datos)) return;

        $.ajax({ url: `/cuenta/${id}/actualizar`, type: 'PUT', data: datos,

            success: function(){

                mostrarToast('Cuenta actualizada correctamente', 'success');
                tabla.ajax.reload();
                bootstrap.Modal.getInstance('#modalEditarCuenta').hide();

            },
            error: manejarErrorAjax
        });

    });

/* ═════════════════════════════════════════ */

    function validarCuenta(d){
        if(d.nombre_cuenta === '') return toastError('El nombre es obligatorio');
        if(d.tipo_cuenta === '') return toastError('El tipo es obligatorio');
        if(d.saldo_actual === '' || parseFloat(d.saldo_actual) < 0) return toastError('Saldo inválido');
        return true;
    }


/* ════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

/* ═════════════ ( MODAL MOVIMIENTOS ) ═════════════ */

    function abrirModalMovimiento(cuenta, tipo){

        $('#modalMovimiento').remove();

        /* ═════════════ ( CONFIGURACIÓN ) ═════════════ */

        let titulo = tipo === 'AGREGAR' ? 'Agregar Saldo' : 'Retirar Saldo';
        let colorBtn = tipo === 'AGREGAR' ? 'success' : 'danger';
        let saldoActual = parseFloat(cuenta.saldo_actual);
        let opcionesConcepto = tipo === 'AGREGAR'
            ? `
                <option value="">-- Seleccionar --</option>
                <option>Depósito</option>
                <option>Ingreso por venta</option>
                <option>Transferencia recibida</option>
                <option>Otros ingresos</option>
            `
            : `
                <option value="">-- Seleccionar --</option>
                <option>Pago proveedor</option>
                <option>Gasto operativo</option>
                <option>Retiro de efectivo</option>
                <option>Otros egresos</option>
            `;

        /* ═════════════ ( HTML MODAL ) ═════════════ */

        let html = `
        <div class="modal fade" id="modalMovimiento" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header text-white py-2">
                        <h6 class="modal-title">${titulo}</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body py-2">

                        <input type="hidden" id="movimiento_id_cuenta" value="${cuenta.id_cuenta}">
                        <input type="hidden" id="tipo_movimiento" value="${tipo}">
                        <input type="hidden" id="saldo_base" value="${saldoActual}">

                        <!-- ═════════════ ( INFO CUENTA ) ═════════════ -->

                        <div class="mb-2">
                            <label class="form-label small mb-0">Cuenta</label>
                            <input type="text" class="form-control form-control-sm"
                                value="${cuenta.nombre_cuenta}" disabled>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small mb-0">Saldo actual</label>
                            <input type="text" class="form-control form-control-sm"
                                value="C$ ${saldoActual.toLocaleString('es-NI',{minimumFractionDigits:2})}" disabled>
                        </div>

                        <!-- ═════════════ ( MONTO ) ═════════════ -->

                        <div class="mb-2">
                            <label class="form-label small mb-0">
                                ${tipo === 'AGREGAR' ? 'Monto a agregar' : 'Monto a retirar'}
                            </label>
                            <input type="number" step="1" min="0"
                                class="form-control form-control-sm"
                                id="monto_movimiento">
                        </div>

                        <!-- ═════════════ ( TIPO CONCEPTO ) ═════════════ -->

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="usar_input_descripcion">
                            <label class="form-check-label small">
                                Escribir concepto manual
                            </label>
                        </div>

                        <!-- ═════════════ ( SELECTOR ) ═════════════ -->

                        <div class="mb-2" id="grupo_selector">
                            <label class="form-label small mb-0">Concepto</label>
                            <select class="form-select form-select-sm" id="selector_concepto">
                                ${opcionesConcepto}
                            </select>
                        </div>

                        <!-- ═════════════ ( INPUT MANUAL ) ═════════════ -->

                        <div class="mb-2 d-none" id="grupo_input">
                            <label class="form-label small mb-0">Concepto manual</label>
                            <input type="text" class="form-control form-control-sm" id="input_concepto">
                        </div>

                        <!-- ═════════════ ( RESULTADO ) ═════════════ -->

                        <div class="mb-2">
                            <label class="form-label small mb-0">Saldo resultante</label>
                            <input type="text"
                                class="form-control form-control-sm fw-bold"
                                id="saldo_resultante" disabled>
                        </div>

                    </div>

                    <div class="modal-footer py-2">
                        <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button class="btn btn-sm btn-${colorBtn}" id="btnGuardarMovimiento">
                            Confirmar
                        </button>
                    </div>

                </div>
            </div>
        </div>
        `;

        /* ═════════════ ( RENDER MODAL ) ═════════════ */

        $('body').append(html);
        new bootstrap.Modal(document.getElementById('modalMovimiento')).show();
        actualizarResultado();

    }

/* ═════════════ ( EVENTOS MODAL MOVIMIENTO ) ═════════════ */

    $(document).on('input', '#monto_movimiento', actualizarResultado);

    $(document).on('change', '#usar_input_descripcion', function(){
        $('#grupo_selector').toggleClass('d-none', this.checked);
        $('#grupo_input').toggleClass('d-none', !this.checked);
    });

/* ═════════════════════════════════════════ */

    function actualizarResultado(){

        const tipo = $('#tipo_movimiento').val();
        const base = parseFloat($('#saldo_base').val());
        const monto = parseFloat($('#monto_movimiento').val()) || 0;

        let res = tipo === 'AGREGAR' ? base + monto : base - monto;

        let input = $('#saldo_resultante');

        input.val('C$ ' + res.toLocaleString('es-NI', {minimumFractionDigits:2}))
             .removeClass('text-success text-danger')
             .addClass(res >= 0 ? 'text-success' : 'text-danger');
    }


    let procesandoMovimiento = false;

/* ═══════ variable global segura ═══════ */

    window.procesandoMovimiento = window.procesandoMovimiento || false;

    $(document)
    .off('click', '#btnGuardarMovimiento')
    .on('click', '#btnGuardarMovimiento', function () {

        const btn = $(this);

        if (window.procesandoMovimiento || btn.prop('disabled')) return; // Evitar doble click

        window.procesandoMovimiento = true;

        const data = {
            id_cuenta: $('#movimiento_id_cuenta').val(),
            tipo_movimiento: $('#tipo_movimiento').val(),
            monto: parseFloat($('#monto_movimiento').val()),
            descripcion: obtenerDescripcion(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        if (!validarMovimiento(data)) { window.procesandoMovimiento = false; return; }
        btn.prop('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i> Procesando...');

        $.ajax({ url: '/cuenta/movimiento', type: 'POST', data,

            success: function (res) {

                mostrarToast(res.mensaje, 'success');
                if (typeof tabla !== 'undefined') { tabla.ajax.reload(null, false); }
                const modalEl = document.getElementById('modalMovimiento');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                modalInstance?.hide();

            }, error: function (xhr) { manejarErrorAjax(xhr); },

            complete: function () { window.procesandoMovimiento = false;
                btn.prop('disabled', false)
                .html('<i class="bi bi-check-circle me-1"></i> Confirmar');
            }

        });
        
    });

/* ═════════════════════════════════════════ */

    function obtenerDescripcion(){
        if($('#usar_input_descripcion').is(':checked')){ return $('#input_concepto').val().trim(); }
        return $('#selector_concepto').val();
    }

/* ═════════════════════════════════════════ */

    function validarMovimiento(d){
        if(!d.monto || d.monto <= 0) return toastError('Monto inválido');
        if(!d.descripcion) return toastError('Concepto requerido');
        return true;
    }


/* ════════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

/* ═════════════ ( HELPERS ) ═════════════ */

    function manejarErrorAjax(err){
        console.error(err);

        if(err.status === 422){
            let e = err.responseJSON.errors;
            for(let k in e) return mostrarToast(e[k][0], 'danger');
        }

        mostrarToast(err.responseJSON?.mensaje || 'Error del servidor', 'danger');
    }

    function toastError(msg){ mostrarToast(msg, 'danger'); return false; }
    $(document).on('hidden.bs.modal', '#modalMovimiento', function () { $(this).remove(); });

});