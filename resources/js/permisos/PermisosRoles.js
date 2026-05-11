$(document).ready(function () {


    console.log('pepe')

    const selectRol = document.getElementById('selectRol');
    const contenedor = document.getElementById('contenedorPermisos');

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
    }

    // ═══════════════════════════════════════
    // 2. LLENAR SELECT ROLES
    // ═══════════════════════════════════════
    function llenarRoles(roles) {

        selectRol.innerHTML = `<option value="">Seleccione un rol</option>`;

        roles.forEach(rol => {

            selectRol.innerHTML += `
                <option value="${rol.id_rol}">
                    ${rol.nombre_rol}
                </option>
            `;
        });
    }

    // ═══════════════════════════════════════
    // 3. EVENTO CAMBIO DE ROL
    // ═══════════════════════════════════════
    selectRol.addEventListener('change', (e) => {

        rolSeleccionado = parseInt(e.target.value);

        if (!rolSeleccionado) {
            contenedor.innerHTML = '';
            return;
        }

        renderPermisos(rolSeleccionado);
    });

    // ═══════════════════════════════════════
    // 4. RENDER PERMISOS AGRUPADOS POR MÓDULO
    // ═══════════════════════════════════════
    function renderPermisos(idRol) {

        const permisos = dataGlobal.permisos;
        const rol = dataGlobal.roles.find(r => r.id_rol == idRol);

        contenedor.innerHTML = '';

        // agrupar por módulo
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
                    <div class="form-check d-flex justify-content-between align-items-center border-bottom py-1">

                        <label class="form-check-label">
                            ${permiso.nombre_permiso}
                        </label>

                        <input 
                            type="checkbox"
                            class="form-check-input permiso-check"
                            data-id="${permiso.id_permiso}"
                            ${checked ? 'checked' : ''}
                        >

                    </div>
                `;
            });

            contenedor.innerHTML += `
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button collapsed" 
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#${collapseId}">
                            ${modulo}
                        </button>

                    </h2>

                    <div id="${collapseId}" 
                         class="accordion-collapse collapse">

                        <div class="accordion-body">
                            ${itemsHTML}
                        </div>

                    </div>

                </div>
            `;

            index++;
        }

        activarEventosCheckbox();
    }

    // ═══════════════════════════════════════
    // 5. EVENTOS CHECKBOX
    // ═══════════════════════════════════════
    function activarEventosCheckbox() {

        document.querySelectorAll('.permiso-check').forEach(check => {

            check.addEventListener('change', async (e) => {

                const idPermiso = e.target.getAttribute('data-id');
                const asignar = e.target.checked;

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

                    mostrarToast(data.mensaje, data.success ? 'success' : 'danger');

                } catch (error) {

                    mostrarToast('Error al actualizar permiso', 'danger');
                }
            });
        });
    }

    // ═══════════════════════════════════════
    // 6. TOAST
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