// resources/js/app.js

import './bootstrap'; // Gardez cette ligne si vous l'utilisez pour d'autres configurations Laravel

// Importation CORRECTE de Flowbite. C'est tout.
import 'flowbite'; 

// Importation CORRECTE d'Alpine.js. C'est tout.
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();