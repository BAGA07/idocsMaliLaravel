// import { defineConfig } from "vite";
// import laravel from "laravel-vite-plugin";

// import tailwindcss from "tailwindcss"; // ✅ La bonne ligne

// export default defineConfig({
//     server: {
//         host: true,
//         hmr: {
//             //ici on remplace par le nom de domaine que ngrok nous a fourni
//             host: "01a3153cbecd.ngrok-free.app",
//         },
//     },
//     plugins: [
//         laravel({
//             input: ["resources/css/app.css", "resources/js/app.js"],
//             refresh: true,
//         }),
//         tailwindcss(), // Cela fonctionne maintenant
//     ],
// });
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    // server: {
    //     host: "0.0.0.0",
    //     hmr: {
    //         host: "1f37ad69d63b.ngrok-free.app", // remplace par ton URL ngrok sans https://
    //         protocol: "wss", // important si ngrok https, websocket sécurisé
    //         port: 443,
    //     },
    // },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
