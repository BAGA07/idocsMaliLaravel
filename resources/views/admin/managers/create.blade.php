@extends('layouts.admin')

@section('content')
<div class="right_col" role="main">
    <div class="max-w-5xl mx-auto p-6 mt-6 bg-white rounded shadow">

        <h2 class="text-2xl font-semibold text-gray-700 mb-6 flex items-center">
            <i class="fa fa-user-plus text-blue-500 mr-2"></i> Ajouter un nouveau manager
        </h2>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('managers.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name="prenom" class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Adresse</label>
                    <input type="text" name="adresse" class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" name="telephone" class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Structure</label>
                <select name="structure" id="structure" class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                    required>
                    <option value="">-- Sélectionner --</option>
                    <option value="hopital">Hôpital</option>
                    <option value="mairie">Mairie</option>
                </select>
            </div>

            <div class="mb-4" id="select_hopital" style="display: none;">
                <label class="block text-sm font-medium text-gray-700">Hôpital concerné</label>
                <select name="structure_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm" disabled>
                    @foreach($hopitaux as $hopital)
                    <option value="{{ $hopital->id }}">{{ $hopital->nom_hopital }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4" id="select_mairie" style="display: none;">
                <label class="block text-sm font-medium text-gray-700">Mairie concernée</label>
                <select name="structure_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm" disabled>
                    @foreach($mairies as $mairie)
                    <option value="{{ $mairie->id }}">{{ $mairie->nom_mairie }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <button type="reset" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded shadow">
                    Réinitialiser
                </button>
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script pour afficher structure_id selon choix --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const structureSelect = document.getElementById('structure');
        const hopitalDiv = document.getElementById('select_hopital');
        const mairieDiv = document.getElementById('select_mairie');

        const hopitalSelect = hopitalDiv.querySelector('select');
        const mairieSelect = mairieDiv.querySelector('select');

        function toggleStructureFields() {
            const selectedValue = structureSelect.value;

            if (selectedValue === 'hopital') {
                hopitalDiv.style.display = 'block';
                mairieDiv.style.display = 'none';
                hopitalSelect.disabled = false;
                mairieSelect.disabled = true;
            } else if (selectedValue === 'mairie') {
                hopitalDiv.style.display = 'none';
                mairieDiv.style.display = 'block';
                hopitalSelect.disabled = true;
                mairieSelect.disabled = false;
            } else {
                hopitalDiv.style.display = 'none';
                mairieDiv.style.display = 'none';
                hopitalSelect.disabled = true;
                mairieSelect.disabled = true;
            }
        }

        structureSelect.addEventListener('change', toggleStructureFields);
        toggleStructureFields(); // initialiser selon valeur
    });
</script>
@endsection