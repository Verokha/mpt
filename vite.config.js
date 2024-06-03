import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/client/bootstrap.js",
                "resources/scss/client/bootstrap.scss",
                "resources/scss/client/home.scss",
                "resources/scss/client/base.scss",
                "resources/scss/client/study.certificate.scss",
                "resources/scss/panel/base.scss",
                "resources/scss/panel/index.scss",
                "resources/scss/panel/login.scss",
                "resources/js/panel/modal-handler.js",
                "resources/js/client/form-runner.js",
            ],
            refresh: true,
        }),
    ],
});
