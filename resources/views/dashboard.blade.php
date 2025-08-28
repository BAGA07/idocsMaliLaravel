@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    {{-- Dashboard pour citoyen --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="bg-white rounded-lg shadow-lg p-8 text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Bienvenue <strong>{{-- {{ session('user')['nom'] }}
                    --}}</strong>, sur votre Espace Citoyen</h1>
            <p class="text-gray-600 mb-6">Soumettez facilement vos demandes administratives, suivez leur état
                d'avancement et consultez vos documents, en toute sécurité.</p>
            <a href="{{ url('index.php?action=new_demande') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-200">
                Faire une nouvelle demande
            </a>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Statistique - Total des demandes --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fa fa-file-text-o text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{-- {{ $nbDemandes ?? 25 }} --}}</div>
                        <div class="text-sm font-medium text-gray-500">Total des demandes</div>
                        <p class="text-xs text-gray-400">Depuis votre inscription</p>
                    </div>
                </div>
            </div>

            {{-- Statistique - Demandes validées --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fa fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{-- {{ $nbDemandesValidees ?? 20 }} --}}</div>
                        <div class="text-sm font-medium text-gray-500">Demandes validées</div>
                        <p class="text-xs text-gray-400">Prêtes à être retirées ou téléchargées</p>
                    </div>
                </div>
            </div>

            {{-- Statistique - Demandes en attente --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fa fa-hourglass-half text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{-- {{ $nbDemandesEnAttente ?? 5 }} --}}</div>
                        <div class="text-sm font-medium text-gray-500">En attente</div>
                        <p class="text-xs text-gray-400">En cours de traitement</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableau des demandes --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">Liste de vos demandes <span
                            class="text-sm text-gray-500">Suivi en temps réel</span></h2>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fa fa-chevron-up"></i>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Types de demande</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Justificatifs / Actes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Exemple fictif : À remplacer par une boucle @foreach --}}
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{-- {{ $i }} --}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Acte de naissance</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">photo</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fa fa-check mr-1"></i> Validée
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-blue-600 hover:text-blue-900">
                                        <i class="fa fa-pencil mr-1"></i> Modifier
                                    </a>
                                    <a href="#" class="text-red-600 hover:text-red-900">
                                        <i class="fa fa-trash-o mr-1"></i> Supprimer
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Section Famille --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Profil Famille</h3>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-16 w-16 rounded-full"
                                src="{{ asset('gentelella/assets/ 'gentelella/assets/build/images/officier.jpg'') }}"
                                alt="Profile">
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-medium text-gray-900">Nom de la famille</h4>
                            <p class="text-sm text-gray-500">Membre depuis 2023</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Actions rapides</h3>
                <div class="space-y-3">
                    <button
                        class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-200">
                        <i class="fa fa-plus mr-2"></i> Nouvelle demande
                    </button>
                    <button
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-200">
                        <i class="fa fa-download mr-2"></i> Télécharger
                    </button>
                    <button
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-200">
                        <i class="fa fa-cog mr-2"></i> Paramètres
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection