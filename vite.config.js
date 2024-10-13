import { defineConfig } from 'vite';
import { normalizePath } from 'vite'
import { viteStaticCopy } from 'vite-plugin-static-copy'
import laravel from 'laravel-vite-plugin';
import path from 'node:path'

normalizePath(path.resolve(__dirname, 'public')) // C:/project/foo

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
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'node_modules/tinymce',
                    dest: 'assets'
                },
                {
                    src: 'node_modules/source-code-editor-tinymce-plugin/codeeditor',
                    dest: 'assets/tinymce/plugins'
                }
            ]
        })

    ],
});
