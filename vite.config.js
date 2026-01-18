import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import FullReload from 'vite-plugin-full-reload';


export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd());

    const isDev = mode === 'development';

    const config = {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
            FullReload(['resources/views/**/*.blade.php']),
        ],
    };

    // Solo si estamos en desarrollo, agregamos configuración de Vite Dev Server
    if (isDev) {
        const host = env.VITE_DEV_HOST || 'localhost';
        const port = Number(env.VITE_DEV_PORT) || 5174;

        config.server = {
            host: host,
            port: port,
            strictPort: true,
            cors: true,
            hmr: {
                host: env.VITE_HMR_HOST || host,
                port: port,
            },
        };
    }

    return config;
});
