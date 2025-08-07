@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Créer un nouvel officer</h1>
                    <p class="text-gray-600 mt-2">Ajoutez un nouvel officer hôpital ou mairie</p>
                </div>
                <a href="{{ route('manager.officers.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                    <i class="fa fa-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('manager.officers.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations personnelles -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Informations
                            personnelles</h3>

                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nom') border-red-500 @enderror">
                            @error('nom')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
                            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('prenom') border-red-500 @enderror">
                            @error('prenom')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone
                                *</label>
                            <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('telephone') border-red-500 @enderror">
                            @error('telephone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="adresse" class="block text-sm font-medium text-gray-700 mb-1">Adresse *</label>
                            <textarea name="adresse" id="adresse" rows="3" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('adresse') border-red-500 @enderror">{{ old('adresse') }}</textarea>
                            @error('adresse')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Informations de connexion et structure -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Informations de
                            connexion</h3>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe
                                *</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                            @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mt-6">Affectation à
                            une structure</h3>

                        <div>
                            <label for="structure" class="block text-sm font-medium text-gray-700 mb-1">Type de
                                structure *</label>
                            <select name="structure" id="structure" required onchange="updateStructureOptions()"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('structure') border-red-500 @enderror">
                                <option value="mairie" {{ old('structure')=='mairie' ? 'selected' : '' }}>Mairie
                                </option>
                            </select>
                            @error('structure')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="structure_id" class="block text-sm font-medium text-gray-700 mb-1">Structure
                                *</label>
                            <select name="structure_id" id="structure_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('structure_id') border-red-500 @enderror">
                                <option value="">Sélectionner une structure</option>
                            </select>
                            @error('structure_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('manager.officers.index') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                        Annuler
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                        <i class="fa fa-save mr-2"></i> Créer l'officer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const hopitaux = @json($hopitaux);
const mairies = @json($mairies);

function updateStructureOptions() {
    const structureType = document.getElementById('structure').value;
    const structureSelect = document.getElementById('structure_id');
    structureSelect.innerHTML = '<option value="">Sélectionner une structure</option>';
    
   if (structureType === 'mairie') {
        mairies.forEach(mairie => {
            const option = document.createElement('option');
            option.value = mairie.id;
            option.textContent = mairie.nom_mairie;
            structureSelect.appendChild(option);
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const structureType = document.getElementById('structure').value;
    if (structureType) {
        updateStructureOptions();
        document.getElementById('structure_id').value = '{{ old("structure_id") }}';
    }
});
</script>
@endsection