document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.cargar-vista');
    const contenido = document.getElementById('contenido-dinamico');

    // Guardar la URL actualmente cargada
    let urlActual = '';

    // Función para cargar la vista
    async function cargarVista(url) {
        if (url === urlActual) return; // Si ya está cargada, no hacer nada
        urlActual = url;

        try {
            const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const html = await response.text();

            // Insertar contenido
            contenido.innerHTML = html;

            // Ejecutar scripts dentro del contenido
            const scripts = contenido.querySelectorAll('script');
            scripts.forEach(oldScript => {
                const newScript = document.createElement('script');
                if (oldScript.src) {
                    newScript.src = oldScript.src;
                } else {
                    newScript.textContent = oldScript.textContent;
                }
                document.body.appendChild(newScript);
                document.body.removeChild(newScript);
            });
        } catch (err) {
            console.error('Error al cargar la vista:', err);
        }
    }

    // Click en los enlacesa
    links.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const url = link.dataset.url;
            cargarVista(url);
        });
    });

    // Cargar la vista por defecto al abrir la página
    const vistaPorDefecto = "clientes"; // Cambia aquí al endpoint que quieras cargar
    cargarVista(vistaPorDefecto);
});