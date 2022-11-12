import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


const domain = "blog.test";
const homedir = require("os").homedir();

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        https: {
            key: homedir + "/.config/valet/Certificates/" + domain + ".key",
            cert: homedir + "/.config/valet/Certificates/" + domain + ".crt",
        },
        host: domain,
        hmr: {
            host: domain,
        }
    }
});