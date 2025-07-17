<aside class="w-64 h-screen bg-blue-900 text-white flex flex-col fixed left-0 top-0 z-40 shadow-lg">

    <!-- Logo -->
    <div class="flex items-center justify-center h-16 bg-blue-800 text-xl font-bold">
        <i class="fa fa-stethoscope mr-2"></i> Idocs Mali
    </div>

    <!-- Infos utilisateur -->
    <div class="p-4 border-b border-blue-700 text-center">
        <img src="{{ Auth::user()->photo }}" class="w-16 h-16 mx-auto rounded-full border-2 border-white object-cover"
            alt="Avatar">
        <p class="mt-2 text-sm text-white/80">Bienvenue,</p>
        <p class="font-bold">{{ Auth::user()->nom }}</p>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto px-4 py-4">
        <h3 class="text-white/60 text-xs uppercase mb-2">Menu principal</h3>
        <ul class="space-y-2 text-sm">

            {{-- Agent Hôpital --}}
            @if(Auth::user()->role === 'agent_hopital')
            <li>
                <a href="{{ route('hopital.dashboard') }}" class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-home w-5 mr-2 text-white"></i> Accueil
                </a>
            </li>
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-users w-5 mr-2 text-white"></i> Naissances
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="{{ route('hopital.dashboard') }}" class="block px-2 py-1 hover:text-white">Liste
                                complète</a></li>
                        <li><a href="{{ route('naissances.create') }}" class="block px-2 py-1 hover:text-white">Nouvelle
                                déclaration</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Non traitées</a></li>
                    </ul>
                </details>
            </li>
            @endif

            {{-- Agent État civil --}}
            @if(Auth::user()->role === 'agent_mairie')
            <li>
                 <li>
                <a href="{{ route('hopital.dashboard') }}" class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-home w-5 mr-2 text-white"></i> Accueil
                </a>
            </li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-file-text-o w-5 mr-2 text-white"></i> Demandes
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">
    <li><a href="{{ route('agent.dashboard') }}" class="block px-2 py-1 hover:text-white">Toutes les demandes</a></li>
    <li><a href="{{ route('agent.dashboard', ['statut' => 'En attente']) }}" class="block px-2 py-1 hover:text-white">En attente</a></li>
    <li><a href="{{ route('agent.dashboard', ['statut' => 'validé']) }}" class="block px-2 py-1 hover:text-white">Traitées</a></li>
    <li><a href="{{ route('agent.dashboard', ['statut' => 'rejeté']) }}" class="block px-2 py-1 hover:text-white">Rejetées</a></li>
</ul>

                </details>
            </li>
            @endif

            {{-- Admin --}}
            @if(Auth::user()->role === 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i> Tableau de bord
                </a>
            </li>
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-users w-5 mr-2 text-white"></i> Managers
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="{{ route('managers.index') }}" class="block px-2 py-1 hover:text-white">Accueil</a>
                        </li>
                        <li><a href="{{ route('managers.index') }}" class="block px-2 py-1 hover:text-white">Liste des
                                managers</a></li>
                        <li><a href="{{ route('managers.create') }}" class="block px-2 py-1 hover:text-white">Ajouter un
                                manager</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-user w-5 mr-2 text-white"></i> Officiers
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="{{ route('structure.list') }}" class="block px-2 py-1 hover:text-white">Accueil</a>
                        </li>
                        <li><a href="{{ route('managers.index') }}" class="block px-2 py-1 hover:text-white">Liste des
                                officiers</a></li>
                        <li><a href="{{ route('managers.create') }}" class="block px-2 py-1 hover:text-white">Ajouter un
                                officier</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-edit w-5 mr-2 text-white"></i> Structures
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Liste des structures</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Ajouter une structure</a></li>
                    </ul>
                </details>
            </li>
            @endif
        </ul>
    </nav>

    <!-- Déconnexion -->
    <div class="p-4 border-t border-blue-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 text-white hover:bg-red-600 px-4 py-2 rounded-md transition duration-200">
                <i class="fa fa-sign-out"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>