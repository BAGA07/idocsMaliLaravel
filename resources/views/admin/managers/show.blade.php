@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-5xl mx-auto px-4">

        <div class="bg-white shadow rounded-lg">
            <div class="flex justify-between items-center bg-blue-500 text-white px-6 py-4 rounded-t">
                <h2 class="text-lg font-semibold"><i class="fa fa-user mr-2"></i>Détails du Manager</h2>
                <a href="{{ route('managers.edit', $manager->id) }}"
                    class="bg-white text-blue-600 hover:bg-blue-100 px-3 py-1 rounded text-sm font-medium">
                    <i class="fa fa-edit mr-1"></i>Modifier
                </a>
            </div>

            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                    <div><strong>Nom :</strong> {{ $manager->nom }}</div>
                    <div><strong>Prénom :</strong> {{ $manager->prenom }}</div>
                    <div><strong>Email :</strong> {{ $manager->email }}</div>
                    <div><strong>Téléphone :</strong> {{ $manager->telephone }}</div>
                    <div><strong>Adresse :</strong> {{ $manager->adresse }}</div>
                    <div>
                        <strong>Structure :</strong>
                        @if($manager->hopital)
                        <span class="text-blue-700">Hôpital – {{ $manager->hopital->nom_hopital }}</span>
                        @elseif($manager->mairie)
                        <span class="text-green-700">Mairie – {{ $manager->mairie->nom_mairie }}</span>
                        @else
                        <span class="text-red-600">Non assigné</span>
                        @endif
                    </div>
                    <div><strong>Date de création :</strong> {{ $manager->created_at->format('d/m/Y H:i') }}</div>
                    <div><strong>Dernière mise à jour :</strong> {{ $manager->updated_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 rounded-b text-right">
                <a href="{{ route('managers.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded bg-gray-100 hover:bg-gray-200 text-gray-700">
                    <i class="fa fa-arrow-left mr-2"></i>Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection