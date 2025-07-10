<header class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold text-primary">Tableau de bord</h1>
    <div class="flex items-center space-x-4">
        <span class="text-gray-600">{{ Auth::user()->nom }}</span>
        <img src="{{ Auth::user()->photo }}" class="w-8 h-8 rounded-full" alt="">
    </div>
</header>