import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            buildDirectory: "public/build", // Set the correct build directory
        }),
    ],
    build: {
        outDir: "public/build",
        manifest: true,
        assetsDir: "assets",
        rollupOptions: {
            output: {
                assetFileNames: "assets/[name]-[hash].[ext]",
                entryFileNames: "assets/[name]-[hash].js",
            },
        },
    },
});
