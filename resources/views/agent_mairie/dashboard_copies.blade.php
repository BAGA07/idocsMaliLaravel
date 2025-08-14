@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Tableau de bord - Gestion des copies/extraits</h2>

    {{-- Messages Flash --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Succès !</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Information</p>
                    <p class="text-sm">{{ session('info') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-4 w-4 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Erreur !</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

<!-- Section Copies/Extraits -->
    <div class="mb-12 p-6 bg-green-50 border border-green-200 rounded">
        <h2 class="text-xl font-bold mb-4 text-green-800">Gestion des copies/extraits</h2>
        {{-- Tableau 1 : Copies/extraits traités (non envoyés à l'officier) --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">Copies/extraits traités (non envoyés à l'officier)</h3>
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Numéro acte</th>
                        <th class="px-4 py-2 border">Nom enfant</th>
                        <th class="px-4 py-2 border">Date naissance</th>
                        <th class="px-4 py-2 border">Statut</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($copies as $copie)
                        <tr>
                            <td class="px-4 py-2 border">{{ $copie->num_acte }}</td>
                            <td class="px-4 py-2 border">{{ $copie->prenom }} {{ $copie->nom }}</td>
                            <td class="px-4 py-2 border">{{ $copie->date_naissance_enfant }}</td>
                            <td class="px-4 py-2 border">
                                @if($copie->statut)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($copie->statut == 'En attente de signature') bg-yellow-100 text-yellow-800
                                        @elseif($copie->statut == 'Finalisé') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $copie->statut }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Traité
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border space-x-2">
                                <a href="{{ route('copies.show', $copie->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                                @if(!$copie->statut || $copie->statut != 'En attente de signature')
                                    <form method="POST" action="{{ route('copies.envoyer_officier', $copie->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir envoyer cette copie à l\'officier ?')">
                                            Envoyer à l'officier
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tableau 2 : Copies/extraits en attente de signature --}}
        <div class="mb-10 mt-12">
            <h3 class="text-xl font-semibold mb-4 text-yellow-700">Copies/extraits en attente de signature</h3>
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Numéro acte</th>
                        <th class="px-4 py-2 border">Nom enfant</th>
                        <th class="px-4 py-2 border">Date naissance</th>
                        <th class="px-4 py-2 border">Statut</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($copiesEnAttente as $copie)
                    <tr>
                        <td class="px-4 py-2 border">{{ $copie->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $copie->prenom }} {{ $copie->nom }}</td>
                        <td class="px-4 py-2 border">{{ $copie->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                {{ $copie->statut }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('copies.show', $copie->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tableau 3 : Copies/extraits finalisés par l'officier --}}
        <div class="mb-10 mt-12">
            <h3 class="text-xl font-semibold mb-4 text-green-700">Copies/extraits finalisés (signés par l'officier)</h3>
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Numéro acte</th>
                        <th class="px-4 py-2 border">Nom enfant</th>
                        <th class="px-4 py-2 border">Date naissance</th>
                        <th class="px-4 py-2 border">Statut</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($copiesFinalises as $copie)
                    <tr>
                        <td class="px-4 py-2 border">{{ $copie->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $copie->prenom }} {{ $copie->nom }}</td>
                        <td class="px-4 py-2 border">{{ $copie->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $copie->statut }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('copies.show', $copie->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                            <a href="{{ route('acte.pdf', $copie->id) }}" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">PDF</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
