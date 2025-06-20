import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import tailwindcss from 'tailwindcss'; // ✅ La bonne ligne

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    tailwindcss(), // Cela fonctionne maintenant
  ],
});

