@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fa fa-user-plus text-blue-500 mr-2"></i> Ajouter un nouveau manager
            </h2>

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.managers.create') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="nom"
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prénom</label>
                        <input type="text" name="prenom"
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Adresse</label>
                        <input type="text" name="adresse"
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="text" name="telephone"
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" name="password"
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Structure</label>
                    <select name="structure" id="structure"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">-- Sélectionner --</option>
                        <option value="hopital">Hôpital</option>
                        <option value="mairie">Mairie</option>
                    </select>
                </div>

                <div class="mb-4" id="select_hopital" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700">Hôpital concerné</label>
                    <select name="structure_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        disabled>
                        @foreach($hopitaux as $hopital)
                        <option value="{{ $hopital->id }}">{{ $hopital->nom_hopital }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4" id="select_mairie" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700">Mairie concernée</label>
                    <select name="structure_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        disabled>
                        @foreach($mairies as $mairie)
                        <option value="{{ $mairie->id }}">{{ $mairie->nom_mairie }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="reset"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition duration-200">
                        Réinitialiser
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition duration-200">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script pour afficher structure_id selon choix --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const structureSelect = document.getElementById('structure');
        const hopitalDiv = document.getElementById('select_hopital');
        const mairieDiv = document.getElementById('select_mairie');

        structureSelect.addEventListener('change', function () {
            const selectedValue = this.value;
            
            // Masquer tous les divs
            hopitalDiv.style.display = 'none';
            mairieDiv.style.display = 'none';
            
            // Désactiver tous les selects
            hopitalDiv.querySelector('select').disabled = true;
            mairieDiv.querySelector('select').disabled = true;
            
            // Afficher le div correspondant
            if (selectedValue === 'hopital') {
                hopitalDiv.style.display = 'block';
                hopitalDiv.querySelector('select').disabled = false;
            } else if (selectedValue === 'mairie') {
                mairieDiv.style.display = 'block';
                mairieDiv.querySelector('select').disabled = false;
            }
        });
    });
</script>
@endsection