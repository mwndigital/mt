import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/assets/sass/app.scss",
                "resources/assets/sass/admin.scss",
                "resources/assets/sass/frontend.scss",
                "resources/assets/sass/customer.scss",
                "resources/assets/js/app.js",
                "resources/assets/js/admin.js",
                "resources/assets/js/upload.js",
                "resources/assets/js/frontend.js",
                "resources/components/Calendar.jsx",
                "resources/components/BookingForm.jsx",
            ],
            refresh: true,
        }),
        react(),
    ],
    resolve: {
        alias: {
            "@": "resources/components",
        },
    },
    // optimizeDeps: ["react", "react-dom"],
});
