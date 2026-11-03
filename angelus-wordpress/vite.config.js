import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

// Builds the theme's stylesheet, script and fonts into theme/angelus/assets.
export default defineConfig({
    base: './',
    plugins: [tailwindcss()],
    build: {
        outDir: 'theme/angelus/assets',
        emptyOutDir: false,
        assetsInlineLimit: 0,
        rollupOptions: {
            input: { app: 'src/app.js', style: 'src/app.css' },
            output: {
                entryFileNames: 'js/[name].js',
                assetFileNames: (asset) => {
                    const name = asset.names?.[0] ?? asset.name ?? '';
                    if (name.endsWith('.css')) {
                        return 'css/app.css';
                    }
                    if (/\.(woff2?|ttf)$/.test(name)) {
                        return 'fonts/[name][extname]';
                    }

                    return 'images/[name][extname]';
                },
            },
        },
    },
});
