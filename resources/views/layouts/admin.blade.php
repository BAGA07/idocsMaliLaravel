<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration - iDocs Mali')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="d-flex">
        {{-- Sidebar Admin --}}
        <div class="sidebar bg-dark text-white" style="width: 250px; min-height: 100vh;">
            <div class="p-3">
                <h4 class="text-white mb-4">
                    <i class="fas fa-shield-alt me-2"></i>
                    Administration
                </h4>
                
                <nav class="nav flex-column">
                    <a class="nav-link text-white-50 {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Dashboard
                    </a>
                    
                    <a class="nav-link text-white-50 {{ request()->routeIs('admin.managers.*') ? 'active bg-primary' : '' }}" 
                       href="{{ route('managers.index') }}">
                        <i class="fas fa-users me-2"></i>
                        Gestionnaires
                    </a>
                    
                    <a class="nav-link text-white-50 {{ request()->routeIs('admin.structures.*') ? 'active bg-primary' : '' }}" 
                       href="{{ route('admin.structures.index') }}">
                        <i class="fas fa-hospital me-2"></i>
                        Structures
                    </a>
                    
                    <hr class="text-white-50">
                    
                    <a class="nav-link text-white-50" href="{{ route('presentation.index') }}">
                        <i class="fas fa-home me-2"></i>
                        Retour au site
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link text-white-50 border-0 bg-transparent w-100 text-start">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Déconnexion
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        {{-- Contenu principal --}}
        <div class="flex-grow-1">
            {{-- Barre de navigation en haut --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-brand">
                        <i class="fas fa-user-shield me-2"></i>
                        {{ auth()->user()->name }}
                    </span>
                    
                    <div class="navbar-nav ms-auto">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Contenu dynamique --}}
            <main class="p-4">
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

    @stack('scripts')
</body>

</html> 