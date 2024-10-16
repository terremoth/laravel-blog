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
                'resources/css/captcha-audio.css',
                'resources/js/admin.js',
                'resources/js/build_editor.js',
                'resources/js/build_choices.js',
                'resources/css/choices-plugin-bootstrap5.2.css',
                'resources/css/admin-controls.css',
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
