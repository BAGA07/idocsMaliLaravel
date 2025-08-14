<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Idocs Mali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{--
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> --}}

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
    @stack('scripts')
    @livewireStyles
    @livewireScripts
</body>

</html>