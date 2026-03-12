document.addEventListener("click", async function(e) {

    if (e.target.classList.contains("bajaProveedor")) {

        const id = e.target.dataset.id;
        let modalElement = document.getElementById("modalConfirmarEstadoProveedor");

        // Crear modal si no existe
        if (!modalElement) {
            const modalHTML = `
            <div class="modal fade" id="modalConfirmarEstadoProveedor" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar acción</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            ¿Deseas cambiar el estado de este proveedor?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-danger" id="confirmarCambioEstadoProveedor">Confirmar</button>
                        </div>

                    </div>
                </div>
            </div>`;
            
            document.body.insertAdjacentHTML("beforeend", modalHTML);
            modalElement = document.getElementById("modalConfirmarEstadoProveedor");
        }

        const modal = new bootstrap.Modal(modalElement);
        modal.show();

        const botonConfirmar = modalElement.querySelector("#confirmarCambioEstadoProveedor");

        botonConfirmar.onclick = async function () {

            try {

                const response = await fetch(`/proveedores/cambiar-estado/${id}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content")
                    }
                });

                const data = await response.json();

                if (data.success) {

                    mostrarToast("Estado del proveedor actualizado", "success");

                    $('#tablaProveedores')
                        .DataTable()
                        .ajax.reload(null, false);

                } else {

                    mostrarToast("Error al cambiar estado", "danger");

                }

            } catch (error) {

                mostrarToast("Error de conexión", "danger");
                console.error(error);

            }

            modal.hide();
        };
    }
});