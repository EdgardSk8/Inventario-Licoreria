document.addEventListener("click", async function(e) {

    if (e.target.classList.contains("bajaUsuario")) {

        const id = e.target.dataset.id;
        let modalElement = document.getElementById("modalConfirmarEstado");// crear modal si no existe

        if (!modalElement) {

            const modalHTML = `
            <div class="modal fade" id="modalConfirmarEstado" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar acción</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            ¿Deseas cambiar el estado de este usuario?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-danger" id="confirmarCambioEstado">Confirmar</button>
                        </div>

                    </div>
                </div>
            </div>`;

            document.body.insertAdjacentHTML("beforeend", modalHTML);
            modalElement = document.getElementById("modalConfirmarEstado");
        }

        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        const botonConfirmar = modalElement.querySelector("#confirmarCambioEstado");

        botonConfirmar.onclick = async function () {

            try {

                const response = await fetch(`/usuarios/cambiar-estado/${id}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content")
                    }
                });

                const data = await response.json();
                
                if (data.success) {
                    mostrarToast("Estado actualizado", "success");
                    $('#tablaUsuarios').DataTable().ajax.reload(null, false);
                } else { mostrarToast("Error al cambiar estado", "danger"); }

            } catch (error) { mostrarToast("Error de conexión", "danger"); }
            modal.hide();
        };
    }
}); //Fin de la fruncion click