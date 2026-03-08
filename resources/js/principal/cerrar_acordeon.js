document.addEventListener("click", function(event) {
    const sidebar = document.querySelector(".sidebar");
    const accordions = document.querySelectorAll(".accordion-collapse");

    // Si el clic NO está dentro del sidebar
    if (!sidebar.contains(event.target)) {
        accordions.forEach(acc => {
            // Cierra solo si está abierto
            if (acc.classList.contains("show")) {
                const collapse = new bootstrap.Collapse(acc, {
                    toggle: false
                });
                collapse.hide();
            }
        });
    }
});
