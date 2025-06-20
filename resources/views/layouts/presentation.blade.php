<!DOCTYPE html>
<html lang="fr">
<<<<<<< HEAD

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil — IDOCS MALI</title>
    @yield('links')
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">


</head>

<body>
    @yield('content')
    <footer style="text-align: center; padding: 20px;margin-top: 5px;">
        <p>&copy; 2025 IDOCS MALI — Tous droits réservés</p>
    </footer>
</body>
@if(session('success'))
<script>
    Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session("success") }}',
            confirmButtonColor: '#198754'
        });
</script>
@endif

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

=======
<head>
    <meta charset="UTF-8">
    {{-- Indispensable pour le responsive design sur mobiles --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MaliActes')</title>

    {{-- Import Vite (CSS/JS). C'est Vite qui va inclure votre app.js (qui importera Flowbite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Lien vers Font Awesome pour les icônes (si vous les utilisez) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-200">

<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ route('presentation.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      {{-- MODIFICATION ICI : h-12 changé en h-16 pour augmenter encore plus la taille du logo --}}
      <img src="{{ asset('images/logo.png') }}" class="h-16" alt="Logo Projet Mali" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">MaliActes</span>
    </a>

    <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>

    <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
      <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="{{ route('presentation.index') }}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-400 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Accueil</a>
        </li>
        {{-- LIEN POUR LA DÉMARCHE DE DEMANDE --}}
        <li>
          <a href="{{ route('presentation.la_demarche') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">La Démarche</a>
        </li>
        <li>
          <a href="{{ route('presentation.suivre_demande') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Suivre ma Demande</a>
        </li>
        <li>
          <a href="{{ route('presentation.a_propos') }}" id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
            Le Projet / À Propos
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </a>
          <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownNavbarLink">
                <li>
                  <a href="{{ route('presentation.a_propos.notre_vision') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Notre Vision</a>
                </li>
                <li>
                  <a href="{{ route('presentation.a_propos.securite_confidentialite') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sécurité & Confidentialité</a>
                </li>
                <li>
                  <a href="{{ route('presentation.a_propos.partenaires') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Partenaires</a>
                </li>
              </ul>
          </div>
        </li>
        <li>
            <a href="{{ route('presentation.faq') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FAQ</a>
        </li>
        <li>
            <a href="{{ route('presentation.contact') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
        </li>

        <li class="md:ml-4">
          <a href="{{ route('demande.create') }}" class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Demander un Acte
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    {{-- Contenu de la page sera inséré ici --}}
    <main>
        @yield('content')
    </main>


</body>
>>>>>>> 98ce78432dfb49134b611cada640fcb8e87255c9
</html>