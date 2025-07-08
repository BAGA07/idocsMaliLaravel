@extends ('layouts.presentation')

@section('title', 'Contact - MaliActes')

@section('content')
<section class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 max-w-3xl">
        <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-800 dark:text-white mb-12">Contactez-nous</h1>

        <p class="text-lg text-gray-700 dark:text-gray-300 text-center mb-10">
            Nous sommes là pour vous aider ! N'hésitez pas à nous contacter pour toute question, suggestion ou problème.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
            {{-- Informations de contact --}}
            <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Nos Coordonnées</h2>
                <ul class="space-y-4 text-gray-700 dark:text-gray-300">
                    <li>
                        <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                        123 Rue de la République, Bamako, Mali
                    </li>
                    <li>
                        <i class="fas fa-envelope text-blue-600 mr-3"></i>
                        <a href="mailto:contact@e-Naissance Mali.ml" class="hover:underline">contact@IdocsMali.ml</a>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt text-blue-600 mr-3"></i>
                        <a href="tel:+22312345678" class="hover:underline">+223 12 34 56 78</a>
                    </li>
                    <li>
                        <i class="fas fa-clock text-blue-600 mr-3"></i>
                        Du Lundi au Vendredi : 9h00 - 17h00 (GMT+0)
                    </li>
                </ul>
                <div class="mt-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Suivez-nous sur les réseaux sociaux :</p>
                    <div class="flex justify-center space-x-6">
                        <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500 text-3xl"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500 text-3xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500 text-3xl"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            {{-- Formulaire de contact --}}
            <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Envoyez-nous un message</h2>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('presentation.contact') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nom Complet:</label>
                        <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 dark:bg-gray-600 dark:text-white leading-tight focus:outline-none focus:shadow-outline focus:ring-blue-500 focus:border-blue-500" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Adresse E-mail:</label>
                        <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 dark:bg-gray-600 dark:text-white leading-tight focus:outline-none focus:shadow-outline focus:ring-blue-500 focus:border-blue-500" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="subject" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Sujet:</label>
                        <input type="text" id="subject" name="subject" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 dark:bg-gray-600 dark:text-white leading-tight focus:outline-none focus:shadow-outline focus:ring-blue-500 focus:border-blue-500" value="{{ old('subject') }}" required>
                        @error('subject')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Votre Message:</label>
                        <textarea id="message" name="message" rows="5" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 dark:bg-gray-600 dark:text-white leading-tight focus:outline-none focus:shadow-outline focus:ring-blue-500 focus:border-blue-500" required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105">
                            Envoyer le Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Section Carte (Optionnel) --}}
        <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-lg shadow-md mt-12">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Où nous trouver ?</h2>
            <div class="relative overflow-hidden rounded-lg" style="padding-bottom: 56.25%;">
                {{-- Remplacez l'iframe par l'intégration de Google Maps pour votre localisation --}}
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15259.98299863489!2d-7.994645062828594!3d12.63152286915233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDM3JzQ0LjMiTiA3wrAwMCcxMy4xIlc!5e0!3m2!1sfr!2sml!4v1678912345678!5m2!1sfr!2sml"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="absolute top-0 left-0 w-full h-full"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection