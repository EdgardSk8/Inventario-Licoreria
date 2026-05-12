$(document).ready(function () {

    document.getElementById('titulo').textContent = 'GESTION DE PERMISOS POR ROL';

    const selectRol = document.getElementById('selectRol');
    const contenedor = document.getElementById('contenedorPermisos');
    const estadoSinRol = document.getElementById('estadoSinRol');

    let dataGlobal = null;
    let rolSeleccionado = null;

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ═══════════════════════════════════════
    // 1. CARGAR DATOS INICIALES
    // ═══════════════════════════════════════
    async function cargarDatos() {

        const res = await fetch('/roles/permisos');
        dataGlobal = await res.json();

        llenarRoles(dataGlobal.roles);

        // estado inicial
        mostrarEstadoSinRol();
    }

    // ═══════════════════════════════════════
    // 2. LLENAR SELECT ROLES
    // ═══════════════════════════════════════
    function llenarRoles(roles) {

        roles.forEach(rol => {

            selectRol.innerHTML += `
                <option value="${rol.id_rol}">
                    ${rol.nombre_rol}
                </option>
            `;
        });
    }

    // ═══════════════════════════════════════
    // 3. CAMBIO DE ROL
    // ═══════════════════════════════════════
    selectRol.addEventListener('change', (e) => {

        rolSeleccionado = parseInt(e.target.value);

        if (!rolSeleccionado) {
            contenedor.innerHTML = '';
            mostrarEstadoSinRol();
            return;
        }

        mostrarPermisos();
        renderPermisos(rolSeleccionado);
    });

    // ═══════════════════════════════════════
    // 4. UI STATES (ESTADO VACÍO / CONTENIDO)
    // ═══════════════════════════════════════
    function mostrarEstadoSinRol() {
        estadoSinRol.style.display = 'flex';
        contenedor.style.display = 'none';
    }

    function mostrarPermisos() {
        estadoSinRol.style.display = 'none';
        contenedor.style.display = 'block';
    }

    // ═══════════════════════════════════════
    // 5. RENDER PERMISOS AGRUPADOS POR MÓDULO
    // ═══════════════════════════════════════
    function renderPermisos(idRol) {

        const permisos = dataGlobal.permisos;
        const rol = dataGlobal.roles.find(r => r.id_rol == idRol);

        contenedor.innerHTML = '';

        const modulos = {};

        permisos.forEach(p => {
            if (!modulos[p.modulo_permiso]) {
                modulos[p.modulo_permiso] = [];
            }
            modulos[p.modulo_permiso].push(p);
        });

        let index = 0;

        for (const modulo in modulos) {

            const collapseId = `modulo_${index}`;
            let itemsHTML = '';

            modulos[modulo].forEach(permiso => {

                const checked = rol.permisos.some(rp => rp.id_permiso === permiso.id_permiso);

                itemsHTML += `
                <label class="permiso-card">

                    <span class="permiso-label">
                        ${permiso.nombre_permiso}
                    </span>

                    <input type="checkbox"
                        class="permiso-check"
                        data-id="${permiso.id_permiso}"
                        ${checked ? 'checked' : ''}>

                </label>
                `;
            });

            contenedor.innerHTML += `
                <div class="modulo-permisos">

                    <div class="modulo-titulo">
                        ${modulo}
                    </div>

                    <div class="permisos-grid">
                        ${itemsHTML}
                    </div>

                </div>
            `;

            index++;
        }

        activarEventosCheckbox();
    }

    // ═══════════════════════════════════════
    // 6. CHECKBOX EVENTS
    // ═══════════════════════════════════════
    function activarEventosCheckbox() {

        document.querySelectorAll('.permiso-check').forEach(check => {

            // 🔥 guardar estado inicial
            check.dataset.previous = check.checked ? "1" : "0";

            check.addEventListener('change', async (e) => {

                const checkbox = e.target;
                const idPermiso = checkbox.getAttribute('data-id');
                const asignar = checkbox.checked;

                try {

                    const res = await fetch('/roles/permisos/asignar', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            id_rol: rolSeleccionado,
                            id_permiso: idPermiso,
                            asignar: asignar
                        })
                    });

                    const data = await res.json();

                    // 🔥 SI FALLA → revertir checkbox
                    if (!data.success) {
                        checkbox.checked = checkbox.dataset.previous === "1";
                    } else {
                        // actualizar estado guardado
                        checkbox.dataset.previous = checkbox.checked ? "1" : "0";
                    }

                    mostrarToast(data.mensaje, data.success ? 'success' : 'danger');

                } catch (error) {

                    // 🔥 rollback en error de red
                    checkbox.checked = checkbox.dataset.previous === "1";

                    mostrarToast('Error al actualizar permiso', 'danger');
                }
            });
        });
    }

    // ═══════════════════════════════════════
    // 7. TOAST
    // ═══════════════════════════════════════
    function mostrarToast(mensaje, tipo = 'success') {

        const toastEl = document.getElementById('toastMensaje');
        const toastTexto = document.getElementById('toastTexto');

        toastTexto.textContent = mensaje;

        toastEl.className = `toast text-bg-${tipo} border-0`;

        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    // INIT
    cargarDatos();
});