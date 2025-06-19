<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Flowbite</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- ✅ Vite CSS et JS -->
</head>
<body class="p-10 bg-gray-100">

<button class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
  Bouton Tailwind
</button>

<button data-modal-target="demoModal" data-modal-toggle="demoModal" class="bg-green-600 text-white px-4 py-2 rounded">
  Ouvrir Modale
</button>

<div id="demoModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Modale Flowbite</h2>
        <p>Ceci est une modale !</p>
        <button data-modal-hide="demoModal" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">
            Fermer
        </button>
    </div>
</div>



    <!-- ✅ Script JS de Flowbite (important pour le modal) -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.js"></script>
</body>
</html>
