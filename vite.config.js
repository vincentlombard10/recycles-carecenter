import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import fs from 'fs';
import path from 'path';
import tailwindcss from "@tailwindcss/vite";
export default defineConfig({
    plugins: [
        vue(),
        tailwindcss(),
        laravel({
            input: ['resources/scss/app.scss', 'resources/scss/pdf.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
    server: {
        host: 'carecenter.dev',
        https: {
            key: fs.readFileSync(path.resolve(__dirname, 'carecenter.dev-key.pem')),
            cert: fs.readFileSync(path.resolve(__dirname, 'carecenter.dev.pem')),
        },
    }
});
