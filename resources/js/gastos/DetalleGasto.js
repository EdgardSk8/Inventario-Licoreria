$(document).ready(function () {

    /* ═══════════════════════════════
        CACHE
    ═══════════════════════════════ */
    let cajasCache = [];
    let cuentasCache = [];

    function cargarOrigenes(callback) {

        let loaded = 0;

        $.get('/gastos-cajas/mostrar', function (res) {
            if (res.success) cajasCache = res.cajas;
            loaded++;
            if (loaded === 2 && callback) callback();
        });

        $.get('/gastos-cuentas/mostrar', function (res) {
            if (res.success) cuentasCache = res.cuentas;
            loaded++;
            if (loaded === 2 && callback) callback();
        });
    }

    cargarOrigenes();

    /* ═══════════════════════════════
        HELPERS
    ═══════════════════════════════ */

    function buildOrigenSelect(m) {

        let html = `<select class="form-select form-select-sm origen-edit">`;
        html += `<option value="">Seleccione</option>`;

        html += `<optgroup label="Cajas">`;

        cajasCache.forEach(c => {
            html += `
                <option value="caja-${c.id}" ${m.id_caja == c.id ? 'selected' : ''}>
                    Caja #${c.id} - ${c.display}
                </option>
            `;
        });

        html += `</optgroup><optgroup label="Cuentas">`;

        cuentasCache.forEach(c => {
            html += `
                <option value="cuenta-${c.id}" ${m.id_cuenta == c.id ? 'selected' : ''}>
                    ${c.display}
                </option>
            `;
        });

        html += `</optgroup></select>`;

        return html;
    }

    function validarMonto(monto) {

        if (monto === null || monto === '' || isNaN(monto)) {
            mostrarToast('Ingrese un monto válido', 'danger');
            return false;
        }

        if (monto <= 0) {
            mostrarToast('El monto debe ser mayor a 0', 'danger');
            return false;
        }

        return true;
    }

    /* ═══════════════════════════════
        DETALLE
    ═══════════════════════════════ */

    $('#tablaGastos').on('click', '.detalleGasto', function () {

        const id = $(this).data('id');

        $.get(`/gastos/detalle/${id}`, function (res) {

            if (!res.success) {
                mostrarToast('No se pudo cargar el detalle', 'danger');
                return;
            }

            const g = res.gasto;

            $('#detalleNombreGasto').text(g.nombre_gasto);
            $('#detalleTipoGasto').text(g.tipo);
            $('#detalleDescripcion').text(g.descripcion_gasto ?? '—');

            $('#detalleUltimoPago').text(
                g.ultimo_pago_fecha
                    ? formatearFechaDiaHora(g.ultimo_pago_fecha)
                    : 'Nunca'
            );

            let html = '';

            g.movimientos.forEach(m => {

                let origenTexto = '';

                if (m.caja) {
                    origenTexto = `Caja #${m.caja}`;
                } else if (m.cuenta) {
                    origenTexto = `${m.cuenta}`;
                }

                html += `
                    <tr data-id="${m.id}">

                        <td>${formatearFechaDiaHora(m.fecha)}</td>

                        <td>
                            <span class="monto-text">${m.monto}</span>
                            <input type="number"
                                class="form-control form-control-sm d-none monto-edit"
                                value="${m.monto}">
                        </td>

                        <td>
                            <span class="origen-text">${origenTexto}</span>
                            <div class="d-none origen-edit-container">
                                ${buildOrigenSelect(m)}
                            </div>
                        </td>

                        <td>${m.usuario.nombre}</td>

                        <td>
                            <button class="btn btn-success btn-sm editarPago">Editar</button>
                            <button class="btn btn-secondary btn-sm cancelarPago d-none">Cancelar</button>
                            <button class="btn btn-primary btn-sm guardarPago d-none">Guardar</button>
                        </td>

                    </tr>
                `;
            });

            $('#tablaHistorialGasto').html(html);

            new bootstrap.Modal(document.getElementById('modalDetalleGasto')).show();
        });
    });

    /* ═══════════════════════════════
        EDITAR
    ═══════════════════════════════ */

    $('#tablaHistorialGasto').on('click', '.editarPago', function () {

        const tr = $(this).closest('tr');

        tr.find('.monto-text, .origen-text').addClass('d-none');
        tr.find('.monto-edit, .origen-edit-container').removeClass('d-none');

        tr.find('.editarPago').addClass('d-none');
        tr.find('.guardarPago, .cancelarPago').removeClass('d-none');
    });

    /* ═══════════════════════════════
        CANCELAR
    ═══════════════════════════════ */

    $('#tablaHistorialGasto').on('click', '.cancelarPago', function () {

        const tr = $(this).closest('tr');

        tr.find('.monto-text, .origen-text').removeClass('d-none');
        tr.find('.monto-edit, .origen-edit-container').addClass('d-none');

        tr.find('.editarPago').removeClass('d-none');
        tr.find('.guardarPago, .cancelarPago').addClass('d-none');
    });

    /* ═══════════════════════════════
        GUARDAR
    ═══════════════════════════════ */

    $('#tablaHistorialGasto').on('click', '.guardarPago', function () {

        const btn = $(this);

        if (btn.data('loading')) return;
        btn.data('loading', true);

        const tr = $(this).closest('tr');
        const id = tr.data('id');

        const monto = parseFloat(tr.find('.monto-edit').val());
        const origen = tr.find('.origen-edit').val();

        /* VALIDACIONES */
        if (!validarMonto(monto)) {
            btn.data('loading', false);
            return;
        }

        if (!origen) {
            mostrarToast('Seleccione un origen', 'danger');
            btn.data('loading', false);
            return;
        }

        const [tipo, origenId] = origen.split('-');

        $.ajax({
            url: '/gastos/movimiento/editar',
            type: 'POST',
            data: {
                id_movimiento_gasto: id,
                monto: monto,
                id_caja: tipo === 'caja' ? origenId : null,
                id_cuenta: tipo === 'cuenta' ? origenId : null,
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            success: function (res) {

               if (res.success) {

                    mostrarToast('Pago actualizado correctamente', 'success');

                    const tr = btn.closest('tr');

                    // 🔥 volver a modo vista
                    tr.find('.monto-text, .origen-text').removeClass('d-none');
                    tr.find('.monto-edit, .origen-edit-container').addClass('d-none');

                    tr.find('.editarPago').removeClass('d-none');
                    tr.find('.guardarPago, .cancelarPago').addClass('d-none');

                    // opcional: actualizar texto en pantalla sin recargar todo
                    tr.find('.monto-text').text(monto);

                    // refresca tabla principal
                    $('#tablaGastos').DataTable().ajax.reload(null, false);
                } else {
                    mostrarToast(res.mensaje || 'Error al actualizar', 'danger');
                }
            },

            error: function (xhr) {

                console.log("STATUS:", xhr.status);
                console.log("RESPUESTA:", xhr.responseText);

                mostrarToast('Error del servidor', 'danger');
            },

            complete: function () {
                btn.data('loading', false);
            }
        });
    });

});