
function cargarTipoGasto() {

    const modal = document.getElementById("modalCrearGasto");
    const selectTipo = document.getElementById("crear_id_tipo_gasto");

    if (!modal || !selectTipo) return;

    modal.addEventListener("shown.bs.modal", async function () {

        // 🔥 evita recargar cada vez que abres el modal
        if (selectTipo.dataset.loaded === "1") return;

        try {

            const res = await fetch("/tipo-gasto/mostrar");
            const data = await res.json();

            selectTipo.innerHTML = '<option disabled selected value="">Seleccione</option>';

            data.tipos_gasto.forEach(tipo => {
                const option = document.createElement("option");
                option.value = tipo.id_tipo_gasto;
                option.textContent = tipo.nombre_tipo_gasto;
                selectTipo.appendChild(option);
            });

            selectTipo.dataset.loaded = "1";

        } catch (error) {
            mostrarToast("Error al cargar tipos de gasto", "danger");
        }

    });
}

/* ═══════════════════════════════════════════════════════ */

$('#btnGuardarGasto').on('click', function () {

    const nombre = $('#crear_nombre_gasto').val().trim();
    const tipo = $('#crear_id_tipo_gasto').val();
    const descripcion = $('#crear_descripcion_gasto').val().trim();
    const fecha_pago = $('#crear_fecha_pago').val();

    if (!nombre) {
        mostrarToast('Ingrese el nombre del gasto', 'danger');
        return;
    }

    if (!tipo) {
        mostrarToast('Seleccione el tipo de gasto', 'danger');
        return;
    }

    $.ajax({
        url: '/gastos/crear',
        method: 'POST',
        data: {
            nombre_gasto: nombre,
            id_tipo_gasto: tipo,
            descripcion_gasto: descripcion,
            fecha_pago: fecha_pago || null,
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function (res) {

            if (res.success) {

                mostrarToast('Gasto creado correctamente', 'success');

                const modalEl = document.getElementById('modalCrearGasto');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                $('#tablaGastos').DataTable().ajax.reload(null, false);

                limpiarFormularioCrearGasto(); // 🔥 EXTRA

            } else {
                mostrarToast(res.mensaje || 'Error al crear', 'danger');
            }
        },

        error: function () {
            mostrarToast('Error del servidor', 'danger');
        }
    });
});

/* ═══════════════════════════════════════════════════════ */
/* 🔥 LIMPIAR FORMULARIO CREAR */
/* ═══════════════════════════════════════════════════════ */

function limpiarFormularioCrearGasto() {

    $('#crear_nombre_gasto').val('');
    $('#crear_id_tipo_gasto').val('');
    $('#crear_descripcion_gasto').val('');
    $('#crear_fecha_pago').val('');

    const selectTipo = document.getElementById("crear_id_tipo_gasto");

    // 🔥 permite recargar tipos la próxima vez
    if (selectTipo) {
        selectTipo.dataset.loaded = "0";
    }
}

/* ═══════════════════════════════════════════════════════ */
/* 🔥 LIMPIAR AL CERRAR MODAL (EXTRA SEGURIDAD) */
/* ═══════════════════════════════════════════════════════ */

$('#modalCrearGasto').on('hidden.bs.modal', function () {
    limpiarFormularioCrearGasto();
});

/* ═══════════════════════════════════════════════════════ */
/* CARGA INICIAL */
/* ═══════════════════════════════════════════════════════ */

cargarTipoGasto();