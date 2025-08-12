<aside class="w-64 h-screen bg-blue-900 text-white flex flex-col fixed left-0 top-0 z-40 shadow-lg">

    <!-- Logo -->
    <div class="flex items-center justify-center h-16 bg-blue-800 text-xl font-bold">
        <i class="fa fa-stethoscope mr-2"></i> Idocs Mali
    </div>

    <!-- Infos utilisateur -->
    <div class="p-4 border-b border-blue-700 text-center">
        <img src="{{ Auth::user() && Auth::user()->photo ? Auth::user()->photo : asset('images/user.png') }}"
            class="w-16 h-16 mx-auto rounded-full border-2 border-white object-cover" alt="Avatar">
        <p class="mt-2 text-sm text-white/80">Bienvenue,</p>
        <p class="font-bold">{{ Auth::user() ? (Auth::user()->nom ?? 'Utilisateur') : 'Utilisateur' }}</p>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto px-4 py-4">
        <h3 class="text-white/60 text-xs uppercase mb-2">Menu principal</h3>
        <ul class="space-y-2 text-sm">

            {{-- Agent Hôpital --}}
            @if(Auth::user() && Auth::user()->role === 'agent_hopital')
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
            @if(Auth::user() && Auth::user()->role === 'agent_mairie')
            <li>
                <a href="{{ route('agent.dashboard') }}" class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-home w-5 mr-2 text-white"></i> Accueil
                </a>
            </li>
            <li>
                <a href="{{ route('mairie.dashboard.actes') }}" class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-list w-5 mr-2 text-white"></i> Gestion des actes
                </a>
            </li>
            <li>
                <a href="{{ route('mairie.dashboard.copies') }}"
                    class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-copy w-5 mr-2 text-white"></i> Gestion des copies
                </a>
            </li>
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-file-text-o w-5 mr-2 text-white"></i> Demandes
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="{{ route('agent.dashboard') }}" class="block px-2 py-1 hover:text-white">Toutes
                                Demandes
                            </a></li>
                        <li><a href="{{ route('listEnattente') }}" class="block px-2 py-1 hover:text-white">Demandes En
                                Attente
                            </a></li>
                        <li><a href="{{ route('listRejeté') }}" class="block px-2 py-1 hover:text-white">Demandes Rejeté
                            </a></li>
                        <li><a href="{{ route('listTraiter') }}" class="block px-2 py-1 hover:text-white">Demandes
                                Traiter
                            </a></li>

                    </ul>

                </details>
                <!-- Notifications -->

            </li>

            </li>
            @endif

            {{-- Admin --}}
            @if(Auth::user() && Auth::user()->role === 'admin')
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-users w-5 mr-2 text-white"></i> Managers
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Accueil</a>
                        </li>
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Liste des
                                managers</a></li>
                        <li><a href="" class="block px-2 py-1 hover:text-white">Ajouter un
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
                        <li><a href="" class="block px-2 py-1 hover:text-white">Accueil</a>
                        </li>
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Liste des
                                officiers</a></li>
                        <li><a href="" class="block px-2 py-1 hover:text-white">Ajouter un
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
                        <li><a href="{{ route('admin.structures.index') }}"
                                class="block px-2 py-1 hover:text-white">Liste des
                                structures</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Ajouter une structure</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-bar-chart w-5 mr-2 text-white"></i> Rapport
                    </summary>
                    {{-- <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Liste des structures</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Ajouter une structure</a></li>
                    </ul> --}}
                </details>
            </li>
            @endif

            {{-- manager --}}
            @if(Auth::user() && Auth::user()->role === 'manager')
            <li>
            <li>
                <a href="{{ route('manager.managers.index') }}" class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-home w-5 mr-2 text-white"></i> Accueil
                </a>
            </li>
            <details class="group">
                <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                    <i class="fa fa-users w-5 mr-2 text-white"></i> Gestion des Agents
                    <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                </summary>
                <ul class="ml-6 mt-1 space-y-1 text-white/90">

                    <li><a href="{{ route('manager.agents.index') }}" class="block px-2 py-1 hover:text-white">Liste
                            des
                            agents</a></li>
                    <li><a href="{{ route('manager.agents.create') }}" class="block px-2 py-1 hover:text-white">Ajouter
                            un
                            agent</a></li>
                </ul>
            </details>
            <details class="group">
                <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                    <i class="fa fa-user w-5 mr-2 text-white"></i> Gestion des Officiers
                    <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                </summary>
                <ul class="ml-6 mt-1 space-y-1 text-white/90">

                    <li><a href="{{ route('manager.officers.index') }}" class="block px-2 py-1 hover:text-white">Liste
                            des
                            officiers</a></li>
                    <li><a href="{{ route('manager.officers.create') }}"
                            class="block px-2 py-1 hover:text-white">Ajouter
                            un
                            officier</a></li>
                </ul>
            </details>
            </li>
            {{-- <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-user w-5 mr-2 text-white"></i> Officiers
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">

                        <li><a href="" class="block px-2 py-1 hover:text-white">Liste des
                                officiers</a></li>
                        <li><a href="" class="block px-2 py-1 hover:text-white">Ajouter un
                                officier</a></li>
                    </ul>
                </details>
            </li> --}}
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-edit w-5 mr-2 text-white"></i> Structures
                        <i class="fa fa-chevron-down ml-auto text-xs group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="{{ route('manager.agents.index') }}" class="block px-2 py-1 hover:text-white">Liste
                                des
                                Hopitaux de la commune</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Ajouter un hopital</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details class="group">
                    <summary class="flex items-center p-2 rounded hover:bg-blue-700 cursor-pointer">
                        <i class="fa fa-bar-chart w-5 mr-2 text-white"></i> Rapport
                    </summary>
                    {{-- <ul class="ml-6 mt-1 space-y-1 text-white/90">
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Liste des structures</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:text-white">Ajouter une structure</a></li>
                    </ul> --}}
                </details>
            </li>
            @endif
            {{-- Officier --}}
            @if(Auth::user() && Auth::user()->role === 'officier')
            <li>
                <a href="{{ route('officier.dashboard') }}" class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-home w-5 mr-2 text-white"></i> Dashboard Officier
                </a>
            </li>
            <li>
                <a href="{{ route('officier.dashboard') }}#actes"
                    class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-file-alt w-5 mr-2 text-white"></i> Actes à finaliser
                </a>
            </li>
            <li>
                <a href="{{ route('officier.dashboard') }}#copies"
                    class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-copy w-5 mr-2 text-white"></i> Copies/Extraits à finaliser
                </a>
            </li>
            <li>
                <a href="{{ route('officier.historique') }}" class="flex items-center p-2 rounded hover:bg-blue-700">
                    <i class="fa fa-history w-5 mr-2 text-white"></i> Historique
                </a>
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