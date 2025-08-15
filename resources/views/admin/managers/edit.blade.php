@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-6 py-4">
                <h2 class="text-lg font-semibold flex items-center">
                    <i class="fa fa-edit mr-2"></i>Modifier le Manager
                </h2>
            </div>

            <div class="px-6 py-6">
                <form action="{{ route('admin.managers.update', $manager->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Nom</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="nom" value="{{ $manager->nom }}"
                                    class="w-full pl-10 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Prénom</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="prenom" value="{{ $manager->prenom }}"
                                    class="w-full pl-10 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Adresse</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <input type="text" name="adresse" value="{{ $manager->adresse }}"
                                    class="w-full pl-10 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Téléphone</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" name="telephone" value="{{ $manager->telephone }}"
                                    class="w-full pl-10 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" value="{{ $manager->email }}" disabled
                                    class="w-full pl-10 border border-gray-300 rounded-md px-3 py-2 bg-gray-100 cursor-not-allowed">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Nouveau mot de passe</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input type="password" name="password" placeholder="Laisser vide pour ne pas changer"
                                    class="w-full pl-10 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block mb-1 font-medium text-gray-700">Structure</label>
                        <select name="structure" id="structure"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">-- Sélectionner --</option>
                            <option value="hopital" {{ $manager->id_hopital ? 'selected' : '' }}>Hôpital</option>
                            <option value="mairie" {{ $manager->id_mairie ? 'selected' : '' }}>Mairie</option>
                        </select>
                    </div>

                    <div class="mt-4" id="select_hopital"
                        style="display: {{ $manager->id_hopital ? 'block' : 'none' }};">
                        <label class="block mb-1 font-medium text-gray-700">Hôpital concerné</label>
                        <select name="structure_id"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            {{ $manager->id_hopital ? '' : 'disabled' }}>
                            @foreach($hopitaux as $hopital)
                            <option value="{{ $hopital->id }}" {{ $manager->id_hopital == $hopital->id ? 'selected' : ''
                                }}>
                                {{ $hopital->nom_hopital }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4" id="select_mairie" style="display: {{ $manager->id_mairie ? 'block' : 'none' }};">
                        <label class="block mb-1 font-medium text-gray-700">Mairie concernée</label>
                        <select name="structure_id"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            {{ $manager->id_mairie ? '' : 'disabled' }}>
                            @foreach($mairies as $mairie)
                            <option value="{{ $mairie->id }}" {{ $manager->id_mairie == $mairie->id ? 'selected' : ''
                                }}>
                                {{ $mairie->nom_mairie }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.managers.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200">
                            <i class="fa fa-arrow-left mr-2"></i>Retour
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-200">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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