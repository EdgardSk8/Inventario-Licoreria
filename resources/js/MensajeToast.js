// MOSTRAR TOAST
function mostrarToast(mensaje, tipo = "success") {
    const toastElemento = document.getElementById("toastMensaje");
    const toastTexto = document.getElementById("toastTexto");

    toastElemento.className = `toast text-bg-${tipo} border-0`;
    toastTexto.textContent = mensaje;

    const toast = new bootstrap.Toast(toastElemento, { delay: 5000 });
    toast.show();
}