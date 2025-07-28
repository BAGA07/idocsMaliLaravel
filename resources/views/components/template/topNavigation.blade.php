<header class="bg-blue-800 text-white shadow-md px-6 py-3 flex justify-between items-center w-full sticky top-0 z-50">

    <!-- Bouton pour afficher le menu (responsive) -->
    <div class="flex items-center gap-3">
        <span class="text-lg font-semibold hidden md:inline">@yield('titre')</span>
    </div>

    <!-- Section droite : profil + notifications -->
    <div class="flex items-center gap-6">

        <!-- Profil utilisateur -->
        <div class="relative">
            <button class="flex items-center gap-2 focus:outline-none" id="userDropdownBtn">
                <img src="{{ Auth::user() && Auth::user()->photo ? Auth::user()->photo : asset('images/user.png') }}" alt="Profil" class="w-8 h-8 rounded-full border border-white">
                <span class="hidden md:inline">{{ Auth::user() ? (Auth::user()->nom ?? 'Utilisateur') : 'Utilisateur' }}</span>
                <i class="fa fa-chevron-down text-xs"></i>
            </button>

            <!-- Dropdown profil -->
            <div class="hidden absolute right-0 mt-2 w-56 bg-white text-black rounded shadow-md z-50" id="userDropdown">
                <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                    <span class="flex justify-between">
                        <span>Paramètres</span>
                        <span class="bg-red-500 text-white text-xs rounded px-2">50%</span>
                    </span>
                </a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Aide</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                        <i class="fa fa-sign-out mr-2"></i>Déconnexion
                    </button>
                </form>
            </div>
        </div>

    </div>

</header>

<!-- Scripts pour dropdowns -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownBtn = document.getElementById('userDropdownBtn');
        const dropdownMenu = document.getElementById('userDropdown');

        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            // Fermer le menu si on clique ailleurs
            window.addEventListener('click', function () {
                dropdownMenu.classList.add('hidden');
            });

            // Ne pas fermer si on clique dans le menu lui-même
            dropdownMenu.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }
    });
</script>