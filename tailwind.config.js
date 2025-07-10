import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
         './node_modules/flowbite/**/*.js',
    ],

   theme: {
    extend: {
        fontFamily: {
            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        },
        colors: {
            primary: {
                DEFAULT: '#1E3A8A', // Bleu principal
                light: '#3B82F6',   // Variante claire
                dark: '#1E40AF',    // Variante foncée
            },
        },
    },
},


    plugins: [
    require('flowbite/plugin'),
    ],
    
};
