<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    {{-- Indispensable pour le responsive design sur mobiles --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '**IdocsMali**')</title>

  {{-- Import Vite (CSS/JS). C'est Vite qui va inclure votre app.js (qui importera Flowbite) --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Lien vers Font Awesome pour les icônes (si vous les utilisez) --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  {{-- AJOUT IMPORTANT : Styles Livewire --}}
  {{-- @livewireStyles --}}
  <meta charset="UTF-8">
  {{-- Indispensable pour le responsive design sur mobiles --}}
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', '*IdocsMali*')</title>

  {{-- Import Vite (CSS/JS). C'est Vite qui va inclure votre app.js (qui importera Flowbite) --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Lien vers Font Awesome pour les icônes (si vous les utilisez) --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  {{-- SweetAlert2 pour les notifications --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- AJOUT IMPORTANT : Styles Livewire --}}
  @livewireStyles
</head>

<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-200">

  <body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-200">

<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ route('presentation.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      {{-- MODIFICATION ICI : h-12 changé en h-16 pour augmenter encore plus la taille du logo --}}
      <img src="{{ asset('images/logo.png') }}" class="h-16" alt="Logo Projet Mali" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">IdocsMali</span>
    </a>

        <button data-collapse-toggle="navbar-dropdown" type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-dropdown" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>

        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
          <ul
            class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
              <a href="{{ route('presentation.index') }}"
                class="block py-2 px-3 {{ request()->routeIs('presentation.index') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }} rounded md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ request()->routeIs('presentation.index') ? 'md:dark:text-blue-400 dark:bg-blue-600 md:dark:bg-transparent' : '' }}"
                {{ request()->routeIs('presentation.index') ? 'aria-current="page"' : '' }}>Accueil</a>
            </li>
            {{-- LIEN POUR LA DÉMARCHE DE DEMANDE --}}
            <li>
              <a href="{{ route('presentation.la_demarche') }}"
                class="block py-2 px-3 {{ request()->routeIs('presentation.la_demarche') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }} rounded md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ request()->routeIs('presentation.la_demarche') ? 'md:dark:text-blue-400 dark:bg-blue-600 md:dark:bg-transparent' : '' }}"
                {{ request()->routeIs('presentation.la_demarche') ? 'aria-current="page"' : '' }}>La
                Démarche</a>
            </li>
            <li>
              <a href="{{ route('presentation.suivre_demande') }}"
                class="block py-2 px-3 {{ request()->routeIs('presentation.suivre_demande') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }} rounded md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ request()->routeIs('presentation.suivre_demande') ? 'md:dark:text-blue-400 dark:bg-blue-600 md:dark:bg-transparent' : '' }}"
                {{ request()->routeIs('presentation.suivre_demande') ? 'aria-current="page"' : '' }}>Suivre
                ma Demande</a>
            </li>
            <li>
              <a href="{{ route('presentation.a_propos_main') }}" id="dropdownNavbarLink"
                data-dropdown-toggle="dropdownNavbar"
                class="flex items-center justify-between w-full py-2 px-3 {{ request()->routeIs('presentation.a_propos*') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }} rounded md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ request()->routeIs('presentation.a_propos*') ? 'md:dark:text-blue-400 dark:bg-blue-600 md:dark:bg-transparent' : '' }}">
                Le Projet / À Propos
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
                </svg>
              </a>
              <div id="dropdownNavbar"
                class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownNavbarLink">
                  <li>
                    <a href="{{ route('presentation.a_propos.notre_vision') }}"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Notre
                      Vision</a>
                  </li>
                  <li>
                    <a href="{{ route('presentation.a_propos.securite_confidentialite') }}"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sécurité &
                      Confidentialité</a>
                  </li>
                  <li>
                    <a href="{{ route('presentation.a_propos.partenaires') }}"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Partenaires</a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a href="{{ route('presentation.faq') }}"
                class="block py-2 px-3 {{ request()->routeIs('presentation.faq') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }} rounded md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ request()->routeIs('presentation.faq') ? 'md:dark:text-blue-400 dark:bg-blue-600 md:dark:bg-transparent' : '' }}"
                {{ request()->routeIs('presentation.faq') ? 'aria-current="page"' : '' }}>FAQ</a>
            </li>
            <li>
              <a href="{{ route('presentation.contact') }}"
                class="block py-2 px-3 {{ request()->routeIs('presentation.contact') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }} rounded md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ request()->routeIs('presentation.contact') ? 'md:dark:text-blue-400 dark:bg-blue-600 md:dark:bg-transparent' : '' }}"
                {{ request()->routeIs('presentation.contact') ? 'aria-current="page"' : '' }}>Contact</a>
            </li>

            <li class="md:ml-4">
              <a href="{{ route('demande.copie_extrait.create') }}"
                class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
<<<<<<< HEAD
                Demander une copie d'extrait
=======
                Demander un Extrait d'Acte
>>>>>>> salimamodif
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
    {{-- DÉBUT DU FOOTER --}}
    <footer class="bg-blue-900 text-white py-8 mt-auto"> {{-- mt-auto pousse le footer vers le bas --}}
      <div class="container mx-auto px-4 max-w-screen-xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
          {{-- Section 1: À Propos --}}
          <div class="col-span-1">
            <h3 class="text-xl font-semibold mb-4 text-blue-400">À Propos</h3>
            <p class="text-blue-200 text-sm leading-relaxed">
              Notre plateforme  *IdocsMali* vise à *digitaliser et simplifier* vos démarches pour l'obtention et
              la
              gestion des actes de naissance au Mali, en vous garantissant un accès facile et sécurisé à ce document
              essentiel pour votre identité juridique.
            </p>
          </div>

          {{-- Section 2: Liens Rapides --}}
          <div class="col-span-1">
            <h3 class="text-xl font-semibold mb-4 text-blue-400">Liens Rapides</h3>
            <ul class="space-y-2">
              <li><a href="/" class="text-blue-200 hover:text-white transition duration-200 text-sm">Accueil</a></li>
              <li><a href="{{ route('presentation.la_demarche') }}"
                  class="text-blue-200 hover:text-white transition duration-200 text-sm">La Démarche</a></li>
              {{-- Correction : 'demander_acte' n'était pas défini, utilisation de 'choix_type' --}}
              <li><a href="{{ route('demande.copie_extrait.create') }}"
<<<<<<< HEAD
                  class="text-blue-200 hover:text-white transition duration-200 text-sm">Demander une copie d'extrait</a></li>
=======
                  class="text-blue-200 hover:text-white transition duration-200 text-sm">Demander un Extrait d'Acte</a></li>
>>>>>>> salimamodif
              <li><a href="{{ route('presentation.suivre_demande') }}"
                  class="text-blue-200 hover:text-white transition duration-200 text-sm">Suivre ma Demande</a></li>
              <li><a href="{{ route('presentation.faq') }}"
                  class="text-blue-200 hover:text-white transition duration-200 text-sm">FAQ</a></li>
            </ul>
          </div>

          {{-- Section 3: Contact --}}
          <div class="col-span-1">
            <h3 class="text-xl font-semibold mb-4 text-blue-400">Contact</h3>
            <ul class="space-y-2 text-blue-200 text-sm">
              <li><i class="fas fa-map-marker-alt mr-2"></i> Bamako, Mali</li>
              <li><i class="fas fa-phone mr-2"></i> +223 12 34 56 78</li>
              <li><i class="fas fa-envelope mr-2"></i> contact@IdocsMali.com</li>
            </ul>
          </div>

          {{-- Section 4: Suivez-nous --}}
          <div class="col-span-1">
            <h3 class="text-xl font-semibold mb-4 text-blue-400">Suivez-nous</h3>
            <div class="flex space-x-4">
              {{-- Facebook Icon --}}
              <a href="URL_DE_VOTRE_PAGE_FACEBOOK" class="text-blue-200 hover:text-white transition duration-200"
                aria-label="Facebook">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.776-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33V22C17.34 21.128 22 16.991 22 12z"
                    clip-rule="evenodd" />
                </svg>
              </a>

              {{-- LinkedIn Icon --}}
              <a href="URL_DE_VOTRE_PROFIL_LINKEDIN" class="text-blue-200 hover:text-white transition duration-200"
                aria-label="LinkedIn">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                    d="M0 .00099987C0 .00099987 0 24 0 24L5 24L5 7.96200003L0 7.96200003L0 .00099987ZM2.5 6.13600003C3.882 6.13600003 4.999 5.02100003 4.999 3.63600003C4.999 2.25100003 3.882 1.13600003 2.5 1.13600003C1.119 1.13600003 0 2.25100003 0 3.63600003C0 5.02100003 1.119 6.13600003 2.5 6.13600003ZM6.5 7.96200003L6.5 24L11.5 24L11.5 16.035C11.5 14.281 12.898 12.883 14.652 12.883C16.406 12.883 17.5 14.18 17.5 16.035L17.5 24L22.5 24L22.5 15.698C22.5 11.233 19.467 9.13600003 16.924 9.13600003C14.779 9.13600003 13.565 10.379 12.843 11.411L12.843 11.411L12.843 7.96200003L6.5 7.96200003Z"
                    clip-rule="evenodd" />
                </svg>
              </a>

              {{-- GitHub Icon --}}
              <a href="URL_DE_VOTRE_PROFIL_GITHUB" class="text-blue-200 hover:text-white transition duration-200"
                aria-label="GitHub">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                    d="M12 0C5.373 0 0 5.373 0 12c0 5.302 3.438 9.799 8.205 11.387.6.111.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.387-1.334-1.756-1.334-1.756-1.088-.745.083-.73.083-.73 1.205.086 1.838 1.238 1.838 1.238 1.07 1.835 2.809 1.305 3.492.997.108-.775.418-1.305.762-1.605-2.665-.3-5.466-1.33-5.466-5.932 0-1.31.465-2.38 1.235-3.22-.125-.3-.535-1.524.118-3.176 0 0 1-.32 3.3.123A11.06 11.06 0 0112 5.82c1.02.001 2.046.138 3.013.406 2.29-2.03 3.29-3.153 3.29-3.153.653 1.652.243 2.876.12 3.176.77.84 1.233 1.91 1.233 3.22 0 4.61-2.805 5.62-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .32.218.694.825.577C20.565 21.795 24 17.302 24 12c0-6.627-5.373-12-12-12z"
                    clip-rule="evenodd" />
                </svg>
              </a>
            </div>
          </div>
        </div>

        <div class="border-t border-blue-700 pt-6 text-center text-blue-300 text-sm">
          <p>&copy; 2025 IdocsMali. Tous droits réservés.</p>
        </div>
      </div>
    </footer>
    {{-- FIN DU FOOTER --}}

    {{-- AJOUT IMPORTANT : Scripts Livewire --}}
    @livewireScripts
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
