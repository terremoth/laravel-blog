import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/styles.css',
                'resources/js/scripts.js',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/admin.css',
                'resources/js/admin.js',
                '/node_modules/ckeditor4/ckeditor.js',
                '/node_modules/ckeditor4/skins/moono-lisa/editor.css',
                '/node_modules/ckeditor4/lang/en.js',
            ],
            refresh: true,
        }),
    ],
});
