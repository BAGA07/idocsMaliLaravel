@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="flex justify-between items-center bg-blue-600 text-white px-6 py-4">
                <h2 class="text-lg font-semibold flex items-center">
                    <i class="fa fa-user mr-2"></i>Détails du Manager
                </h2>
                <a href="{{ route('admin.managers.edit', $manager->id) }}"
                    class="bg-white text-blue-600 hover:bg-blue-50 px-3 py-1 rounded-md text-sm font-medium transition duration-200">
                    <i class="fa fa-edit mr-1"></i>Modifier
                </a>
            </div>

            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                    <div class="flex items-center">
                        <span class="font-semibold text-gray-900 mr-2">Nom :</span>
                        <span>{{ $manager->nom }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-semibold text-gray-900 mr-2">Prénom :</span>
                        <span>{{ $manager->prenom }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-semibold text-gray-900 mr-2">Email :</span>
                        <span>{{ $manager->email }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-semibold text-gray-900 mr-2">Téléphone :</span>
                        <span>{{ $manager->telephone }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-semibold text-gray-900 mr-2">Adresse :</span>
                        <span>{{ $manager->adresse }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-semibold text-gray-900 mr-2">Structure :</span>
                        @if($manager->hopital)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Hôpital – {{ $manager->hopital->nom_hopital }}
                        </span>
                        @elseif($manager->mairie)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Mairie – {{ $manager->mairie->nom_mairie }}
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Non assigné
                        </span>
                        @endif
                    </div>
                    <div class="flex items-center">
                        <span class="font-semibold text-gray-900 mr-2">Date de création :</span>
                        <span>{{ $manager->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-semibold text-gray-900 mr-2">Dernière mise à jour :</span>
                        <span>{{ $manager->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="{{ route('admin.managers.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200">
                        <i class="fa fa-arrow-left mr-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection