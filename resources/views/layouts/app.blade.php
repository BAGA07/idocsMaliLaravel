<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Idocs Mali</title>

    {{-- Font Awesome est toujours utile pour les icônes. --}}
    <link href="{{ asset('gentelella/assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    {{-- Utilisation de Vite pour les styles (app.css) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Assurez-vous que app.js est inclus pour Alpine.js --}}

    {{-- Optionnel mais recommandé: CDN Flowbite pour les styles de base si vous ne l'avez pas via NPM/Vite --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    {{-- SweetAlert2 pour les alertes (utilisé dans le dashboard) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="icon" type="image" href="{{ asset('gentelella/assets/images/favicon.png') }}">
    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    {{-- Le conteneur principal du layout --}}
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: window.innerWidth >= 640 }">

        {{-- Barre latérale --}}
        <aside id="sidebar"
               class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform duration-300 ease-in-out bg-blue-700 dark:bg-blue-900 text-gray-100 p-4 shadow-lg overflow-y-auto flex flex-col"
               :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">

            <div class="flex items-center justify-center h-16 border-b border-blue-600 dark:border-blue-800 mb-6">
                <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <i class="fa fa-stethoscope text-2xl text-blue-200"></i>
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-blue-100">Idocs Mali</span>
                </a>
            </div>

            <div class="flex items-center space-x-4 mb-6 pb-4 border-b border-blue-600 dark:border-blue-800">
                <div class="flex-shrink-0">
                    <img src="{{ Auth::user()->photo ?? 'https://via.placeholder.com/40' }}" alt="User Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-blue-400">
                </div>
                <div>
                    <div class="text-sm font-medium text-white">Bienvenue,</div>
                    <h2 class="text-lg font-bold text-white">{{ Auth::user()->nom }}</h2>
                </div>
            </div>

            <nav class="flex-grow space-y-2 font-medium">
                <div class="menu_section">
                    <h3 class="text-xs uppercase text-blue-300 dark:text-blue-400 mb-2">Menu principal</h3>
                    <ul class="space-y-1">
                        {{-- Lien du tableau de bord (toujours visible) --}}
                        <li>
                            <a href="{{ url('/dashboard') }}" class="flex items-center p-2 text-blue-100 rounded-lg hover:bg-blue-600 dark:hover:bg-blue-800 group">
                                <i class="fa fa-home text-lg"></i>
                                <span class="ms-3">Tableau de bord</span>
                            </a>
                        </li>

                        @if(Auth::user()->role === 'agent_hopital')
                        <li>
                            <div x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="flex items-center w-full p-2 text-blue-100 rounded-lg group hover:bg-blue-600 dark:hover:bg-blue-800" aria-controls="naissances-submenu">
                                    <i class="fa fa-users text-lg"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Naissances</span>
                                    <svg class="w-3 h-3 ms-2 transform transition-transform text-blue-100" :class="{ 'rotate-180': open }" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <ul id="naissances-submenu" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="py-2 space-y-2">
                                    <li><a href="{{ route('naissances.index') }}" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Liste complète</a></li>
                                    <li><a href="{{ route('naissances.create') }}" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Nouvelle déclaration</a></li>
                                    <li><a href="#" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Non traitées</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif

                        @if(Auth::user()->role === 'agent_etat_civil')
                        <li>
                            <div x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="flex items-center w-full p-2 text-blue-100 rounded-lg group hover:bg-blue-600 dark:hover:bg-blue-800" aria-controls="demandes-submenu">
                                    <i class="fa fa-file-text-o text-lg"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Demandes</span>
                                    <svg class="w-3 h-3 ms-2 transform transition-transform text-blue-100" :class="{ 'rotate-180': open }" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <ul id="demandes-submenu" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="py-2 space-y-2">
                                    <li><a href="{{ route('demandes.index') }}" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Toutes les demandes</a></li>
                                    <li><a href="#" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">En attente</a></li>
                                    <li><a href="#" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Traitées</a></li>
                                    <li><a href="#" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Rejetées</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif

                        @if(Auth::user()->role === 'admin')
                        <li>
                            <div x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="flex items-center w-full p-2 text-blue-100 rounded-lg group hover:bg-blue-600 dark:hover:bg-blue-800" aria-controls="manager-submenu">
                                    <i class="fa fa-users text-lg"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manager</span>
                                    <svg class="w-3 h-3 ms-2 transform transition-transform text-blue-100" :class="{ 'rotate-180': open }" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <ul id="manager-submenu" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="py-2 space-y-2">
                                    <li><a href="{{ route('managers.index') }}" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Liste des managers</a></li>
                                    <li><a href="{{ route('managers.create') }}" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Ajouter un manager</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="flex items-center w-full p-2 text-blue-100 rounded-lg group hover:bg-blue-600 dark:hover:bg-blue-800" aria-controls="officier-submenu">
                                    <i class="fa fa-users text-lg"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Officier</span>
                                    <svg class="w-3 h-3 ms-2 transform transition-transform text-blue-100" :class="{ 'rotate-180': open }" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <ul id="officier-submenu" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="py-2 space-y-2">
                                    <li><a href="{{ route('structure.list') }}" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Liste des Officiers</a></li>
                                    <li><a href="{{ route('managers.create') }}" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Ajouter un Officier</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="flex items-center w-full p-2 text-blue-100 rounded-lg group hover:bg-blue-600 dark:hover:bg-blue-800" aria-controls="structure-submenu">
                                    <i class="fa fa-edit text-lg"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Structure</span>
                                    <svg class="w-3 h-3 ms-2 transform transition-transform text-blue-100" :class="{ 'rotate-180': open }" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <ul id="structure-submenu" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="py-2 space-y-2">
                                    <li><a href="#" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Liste des Structures</a></li>
                                    <li><a href="#" class="flex items-center w-full p-2 text-blue-100 transition duration-75 rounded-lg pl-11 group hover:bg-blue-600 dark:hover:bg-blue-800">Ajouter une structure</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        {{-- Section par défaut si aucun rôle spécifique ne correspond --}}
                        @if (!in_array(Auth::user()->role, ['agent_hopital', 'agent_etat_civil', 'admin']))
                            <li>
                                <a href="{{ url('/fallback-page') }}" class="flex items-center p-2 text-blue-100 rounded-lg hover:bg-blue-600 dark:hover:bg-blue-800 group">
                                    <i class="fa fa-info-circle text-lg"></i>
                                    <span class="ms-3">Page par défaut (accès limité)</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>

            {{-- Nouvelle section pour les actions du bas et le footer --}}
            <div class="mt-auto">
                <ul class="space-y-2 py-4 border-t border-blue-600 dark:border-blue-800">
                    <li>
                        <a href="#" data-tooltip-target="tooltip-lock" class="flex items-center p-2 text-blue-100 rounded-lg hover:bg-blue-600 dark:hover:bg-blue-800 group">
                            <i class="fa fa-lock text-lg"></i>
                            <span class="ms-3">Verrouillé</span>
                        </a>
                        <div id="tooltip-lock" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Verrouiller
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                    <li>
                        <a href="#" data-tooltip-target="tooltip-settings" class="flex items-center p-2 text-blue-100 rounded-lg hover:bg-blue-600 dark:hover:bg-blue-800 group">
                            <i class="fa fa-cog text-lg"></i>
                            <span class="ms-3">Paramètres</span>
                        </a>
                        <div id="tooltip-settings" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Paramètres
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                    <li>
                        <a href="#" data-tooltip-target="tooltip-fullscreen" class="flex items-center p-2 text-blue-100 rounded-lg hover:bg-blue-600 dark:hover:bg-blue-800 group">
                            <i class="fa fa-arrows-alt text-lg"></i>
                            <span class="ms-3">Plein écran</span>
                        </a>
                        <div id="tooltip-fullscreen" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Plein écran
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" data-tooltip-target="tooltip-logout" class="flex items-center p-2 text-blue-100 rounded-lg hover:bg-blue-600 dark:hover:bg-blue-800 group">
                            <i class="fa fa-sign-out text-lg"></i>
                            <span class="ms-3">Déconnexion</span>
                        </a>
                        <div id="tooltip-logout" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Déconnexion
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                </ul>
                <footer class="sidebar-footer text-center text-xs text-blue-300 dark:text-blue-400 py-4">
                    <p>&copy; {{ date('Y') }} Idocs Mali. Tous droits réservés.</p>
                </footer>
            </div>
        </aside>

        {{-- Zone du contenu principal --}}
        <div class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300"
             :class="{'sm:ml-64': sidebarOpen, 'ml-0': !sidebarOpen && window.innerWidth < 640}">

            {{-- Barre de navigation supérieure (Header) --}}
            <nav class="bg-gray-200 dark:bg-gray-700 border-b border-blue-200 dark:border-gray-600 p-4 sticky top-0 z-30 shadow-md">
                <div class="flex justify-between items-center h-full">
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="inline-flex items-center p-2 text-blue-700 rounded-lg sm:hidden hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-blue-300 dark:hover:bg-gray-600 dark:focus:ring-blue-700">
                        <span class="sr-only">Toggle sidebar</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>

                    {{-- Section des notifications et du profil, poussée vers la droite --}}
                    <div class="flex items-center space-x-4 ml-auto">
                        {{-- Notifications --}}
                        <div class="relative" x-data="{ notificationsOpen: false }">
                            <button @click="notificationsOpen = !notificationsOpen" type="button"
                                    class="p-2 text-gray-700 hover:bg-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-gray-300 dark:hover:bg-gray-600 dark:focus:ring-blue-700">
                                <i class="fa fa-envelope-o text-xl"></i>
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2">6</span>
                                <span class="sr-only">Voir les notifications</span>
                            </button>

                            <div x-show="notificationsOpen" @click.away="notificationsOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-md shadow-lg overflow-hidden z-20">
                                <div class="py-2">
                                    <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-700 dark:border-gray-700">
                                        <img class="h-8 w-8 rounded-full object-cover" src="https://via.placeholder.com/40" alt="Notification">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Nouvelle naissance enregistrée par Jean Dupont.</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 2 minutes</p>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-700 dark:border-gray-700">
                                        <img class="h-8 w-8 rounded-full object-cover" src="https://via.placeholder.com/40" alt="Notification">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Demande de rectification de Marie Durand.</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 1 heure</p>
                                        </div>
                                    </a>
                                    <div class="text-center py-2">
                                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">Voir toutes les notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Dropdown de l'utilisateur - CORRIGÉ --}}
                        <div class="relative" x-data="{ profileOpen: false }">
                            <button @click="profileOpen = !profileOpen" type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full object-cover" src="{{ Auth::user()->photo ?? 'https://via.placeholder.com/40' }}" alt="user photo">
                            </button>
                            <div x-show="profileOpen" @click.away="profileOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 md:right-4 lg:right-8 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-20" id="user-dropdown">
                                <div class="px-4 py-3">
                                    <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->nom }}</span>
                                    <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                                </div>
                                <ul class="py-2" aria-labelledby="user-menu-button">
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:hover:text-white">Mon Profil</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:hover:text-white">Paramètres</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:hover:text-white">Déconnexion</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Le contenu du dashboard ou d'autres pages, avec le padding général --}}
            <main class="flex-1 p-4 bg-gray-50 dark:bg-gray-900 overflow-y-auto">
                @yield('content')
            </main>

        </div> {{-- Fin du div principal du contenu --}}
    </div> {{-- Fin du div global flex h-screen --}}

    {{-- Script pour Flowbite (si utilisé) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    {{-- Scripts Livewire --}}
    @livewireScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 min-h-screen text-gray-800">
    <div class="flex">
        {{-- Sidebar à gauche --}}
        <div class="fixed inset-y-0 left-0 w-64 z-40">
            @include('components.template.sidebar')
        </div>

        {{-- Contenu principal avec marge gauche équivalente à la sidebar --}}
        <div class="ml-64 flex-1 min-h-screen">
            {{-- Barre de navigation en haut --}}
            <div class="sticky top-0 z-30 bg-white shadow">
                @include('components.template.topNavigation')
            </div>

            {{-- Contenu dynamique --}}
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- SweetAlert : Messages de succès --}}
    @if(session('success'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif

    {{-- SweetAlert : Messages d'erreur --}}
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: '{{ session("error") }}',
            confirmButtonColor: '#d33'
        });
    </script>
    @endif

    {{-- Fonction de suppression avec confirmation --}}
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Confirmation',
                text: "Voulez-vous vraiment supprimer cet élément ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</body>
</html>
