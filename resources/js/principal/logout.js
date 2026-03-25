$(function(){

    // 🔐 CSRF
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (token) {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': token } });
    }

    // 🧾 Crear modal (una sola vez)
    if (!$('#modalConfirmarLogout').length) {
        $('body').append(`
            <div class="modal fade" id="modalConfirmarLogout" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Cerrar sesión</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            ¿Estás seguro que deseas cerrar sesión?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-danger" id="confirmarLogout">Cerrar sesión</button>
                        </div>

                    </div>
                </div>
            </div>
        `);
    }

    const modalEl = document.getElementById('modalConfirmarLogout');
    const modal = new bootstrap.Modal(modalEl);

    // 🚪 Abrir modal
    $(document).on('click', '#btnLogout', () => modal.show());

    // 🔴 Confirmar logout
    $(document).on('click', '#confirmarLogout', function(){

        const btn = $(this).prop('disabled', true);

        $.post('/logout')
        .done(res => {
            if(res.success){
                modal.hide();
                setTimeout(() => window.location.href = '/login', 500);
            }
        })
        .always(() => btn.prop('disabled', false));

    });

});