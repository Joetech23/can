import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { fontsource } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                fontsource('Marcellus', {
                    weights: [400],
                }),
                fontsource('Manrope', {
                    weights: [400, 500, 600, 700],
                }),
                fontsource('Cormorant Garamond', {
                    alias: 'cormorant',
                    weights: [500],
                    styles: ['italic'],
                    preload: false,
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
