@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <!-- ✅ Titre principal -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Profil de l'utilisateur</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- 🧍‍♂️ Colonne gauche : Informations -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex flex-col items-center text-center">
                <img class="w-32 h-32 rounded-full border object-cover" src="{{ $user->photo  }}" alt="Photo de profil">
                <h3 class="mt-4 text-xl font-semibold text-gray-900">{{ $user->prenom }} {{ $user->nom }}</h3>
                <p class="text-gray-600 mt-1">
                    <i class="fa fa-envelope mr-2"></i>{{ $user->email }}
                </p>
                <p class="text-gray-600 mt-1">
                    <i class="fa fa-phone mr-2"></i>{{ $user->telephone ?? 'Non renseigné' }}
                </p>
                <p class="text-gray-600 mt-1">
                    <i class="fa fa-briefcase mr-2"></i>Rôle : {{ $user->role }}
                </p>
                <a href="#update-form"
                    class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    <i class="fa fa-edit mr-2"></i>Modifier le profil
                </a>
            </div>
        </div>

        <!-- ✏️ Colonne droite : Formulaire -->
        <div id="update-form" class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Mettre à jour le profil</h3>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        value="{{ $user->nom }}">
                </div>

                <!-- Prénom -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name="prenom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        value="{{ $user->prenom }}">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        value="{{ $user->email }}">
                </div>

                <!-- Téléphone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" name="telephone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        value="{{ $user->telephone }}">
                </div>

                <!-- Photo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo de profil</label>
                    <input type="file" name="photo" class="mt-1 block w-full text-sm">
                    @if ($user->photo)
                    <img src="{{ $user->photo }}" alt="Photo actuelle"
                        class="mt-4 w-24 h-24 rounded-full object-cover border">
                    @endif
                </div>

                <!-- Bouton -->
                <div class="pt-4">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection