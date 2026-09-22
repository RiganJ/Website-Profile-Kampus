import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            publicDirectory: 'public',
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/css/inspired-campus.css',
                'resources/css/prodi.css',
                'resources/css/fisiotrapi.css',
                'resources/css/ners.css',
                'resources/css/dkv.css',
                'resources/css/bidan.css',
                'resources/css/bisdig.css',
                'resources/css/farmasi.css',
                'resources/css/kwu.css',
                'resources/css/pariwisata.css',
                'resources/css/psikologi.css',
                'resources/css/style.css',
                'resources/js/app.js',
                'resources/js/admin.js',
                'resources/js/app-biaya.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
