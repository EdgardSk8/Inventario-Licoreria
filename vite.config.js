import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
/* ------------------------------------------------------------------------------------------------------------------------ */
        host: '0.0.0.0', // Escucha en todas las direcciones de red
        cors: true,
        hmr: {
            host: '192.168.18.7', // Reemplaza con tu IP local (ej. 192.168.1.50)
        },
/* ------------------------------------------------------------------------------------------------------------------------ */
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
