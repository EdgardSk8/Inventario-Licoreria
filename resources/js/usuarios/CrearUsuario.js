
// CARGAR ROLES AL ABRIR EL MODAL (estructura compatible con vistas hijas)
function cargarRoles() {

    const modal = document.getElementById("modalCrearUsuario");
    const selectRol = document.getElementById("crear_rol_usuario");
    if (!modal || !selectRol) return;

    // Escuchar cuando el modal se abre
    modal.addEventListener("shown.bs.modal", async function () {
        try {
            const res = await fetch("/roles-usuario/mostrar?estado=1");
            const data = await res.json();

            selectRol.innerHTML = '<option disabled selected value="">Seleccione</option>';

            data.data.forEach(rol => {
                const option = document.createElement("option");
                option.value = rol.id_rol;
                option.textContent = rol.nombre_rol;
                selectRol.appendChild(option);
            });
        } catch (error) {
            mostrarToast("Error al cargar roles", "danger");
        }
    });
}

// ENVIAR FORMULARIO
document.getElementById("btnGuardarUsuario").addEventListener("click", async function () {
    const form = document.getElementById("formCrearUsuario");
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const datos = {
        nombre_completo_usuario: document.getElementById("crear_nombre_completo_usuario").value,
        cedula_identidad_usuario: document.getElementById("crear_cedula_usuario").value,
        nombre_usuario: document.getElementById("crear_nombre_usuario").value,
        id_rol_usuario: document.getElementById("crear_rol_usuario").value,
        password_hash_usuario: document.getElementById("crear_password_usuario").value
    };

    try {
        const response = await fetch("/usuarios/crear", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify(datos)
        });

        const data = await response.json();

        if (data.success) {

            mostrarToast(data.mensaje, "success");

            const modalElement = document.getElementById("modalCrearUsuario");
            const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);

            modal.hide();

            document.body.classList.remove("modal-open");
            document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());

            form.reset();
            
            $('#tablaUsuarios').DataTable().ajax.reload();// actualizar tabla
            
        } else {
            if (data.errors) {
                let mensaje = Object.values(data.errors)[0][0];
                mostrarToast(mensaje, "danger");
            } else {
                mostrarToast("Error al crear usuario", "danger");
            }
        }
    } catch (error) {
        mostrarToast("Error de conexión", "danger");
    }
});

// INICIALIZAR
formatearCedula("crear_cedula_usuario");
cargarRoles();