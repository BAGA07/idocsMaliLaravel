@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Détails de l'officer</h1>
                <p class="text-gray-600 mt-2">Informations complètes de l'officer</p>
            </div>
            <a href="{{ route('manager.officers.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                <i class="fa fa-arrow-left mr-2"></i> Retour
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">

            <!-- Infos personnelles -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Informations personnelles
                </h3>
                <p><strong>Nom :</strong> {{ $officer->nom }}</p>
                <p><strong>Prénom :</strong> {{ $officer->prenom }}</p>
                <p><strong>Email :</strong> {{ $officer->email }}</p>
                <p><strong>Téléphone :</strong> {{ $officer->telephone }}</p>
                <p><strong>Adresse :</strong> {{ $officer->adresse }}</p>
            </div>

            <!-- Affectation -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Affectation</h3>
                @if($officer->hopital)
                <p><strong>Structure :</strong> {{ $officer->hopital->nom_hopital }} (Hôpital)</p>
                @elseif($officer->mairie)
                <p><strong>Structure :</strong> {{ $officer->mairie->nom_mairie }} (Mairie)</p>
                @else
                <p class="text-gray-500">Non assigné</p>
                @endif
            </div>

            <!-- Connexion -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Connexion</h3>
                @if($officer->last_login_at)
                <p><strong>Dernière connexion :</strong> {{
                    \Carbon\Carbon::parse($officer->last_login_at)->format('d/m/Y à H:i') }}</p>
                @else
                <p class="text-gray-500">Jamais connecté</p>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex space-x-4">
                <a href="{{ route('manager.officers.update', $officer->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg">
                    <i class="fa fa-edit mr-2"></i> Modifier
                </a>
                <form action="{{ route('manager.officers.destroy', $officer->id) }}" method="POST"
                    onsubmit="return confirm('Supprimer cet officer ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg">
                        <i class="fa fa-trash mr-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection