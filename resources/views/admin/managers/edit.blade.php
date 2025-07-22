@extends('layouts.admin')

@section('content')
<div class="py-10">
    <div class="max-w-5xl mx-auto px-4">

        @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white shadow rounded-lg">
            <div class="bg-blue-500 text-white px-6 py-4 rounded-t">
                <h2 class="text-lg font-semibold"><i class="fa fa-edit mr-2"></i>Modifier le Manager</h2>
            </div>

            <div class="px-6 py-6">
                <form action="{{ route('managers.update', $manager->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-medium">Nom</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="nom" value="{{ $manager->nom }}"
                                    class="w-full pl-10 border rounded px-3 py-2" required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Prénom</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="prenom" value="{{ $manager->prenom }}"
                                    class="w-full pl-10 border rounded px-3 py-2" required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Adresse</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <input type="text" name="adresse" value="{{ $manager->adresse }}"
                                    class="w-full pl-10 border rounded px-3 py-2" required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Téléphone</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" name="telephone" value="{{ $manager->telephone }}"
                                    class="w-full pl-10 border rounded px-3 py-2" required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" value="{{ $manager->email }}" disabled
                                    class="w-full pl-10 border rounded px-3 py-2 bg-gray-100 cursor-not-allowed">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Nouveau mot de passe</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input type="password" name="password" placeholder="Laisser vide pour ne pas changer"
                                    class="w-full pl-10 border rounded px-3 py-2">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block mb-1 font-medium">Structure</label>
                        <select name="structure" id="structure" class="w-full border px-3 py-2 rounded bg-white"
                            required>
                            <option value="">-- Sélectionner --</option>
                            <option value="hopital" {{ $manager->id_hopital ? 'selected' : '' }}>Hôpital</option>
                            <option value="mairie" {{ $manager->id_mairie ? 'selected' : '' }}>Mairie</option>
                        </select>
                    </div>

                    <div class="mt-4" id="select_hopital" style="display: none;">
                        <label class="block mb-1 font-medium">Hôpital concerné</label>
                        <select name="structure_id" class="w-full border px-3 py-2 rounded bg-white"
                            id="hopital_select">
                            @foreach($hopitaux as $hopital)
                            <option value="{{ $hopital->id }}" {{ $manager->id_hopital == $hopital->id ? 'selected' : ''
                                }}>
                                {{ $hopital->nom_hopital }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4" id="select_mairie" style="display: none;">
                        <label class="block mb-1 font-medium">Mairie concernée</label>
                        <select name="structure_id" class="w-full border px-3 py-2 rounded bg-white" id="mairie_select">
                            @foreach($mairies as $mairie)
                            <option value="{{ $mairie->id }}" {{ $manager->id_mairie == $mairie->id_mairie ? 'selected'
                                : '' }}>
                                {{ $mairie->nom_mairie }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6 text-end">
                        <a href="{{ route('managers.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded bg-gray-100 hover:bg-gray-200 mr-2">
                            <i class="fa fa-arrow-left mr-2"></i>Retour
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-yellow-500 rounded bg-yellow-500 text-white hover:bg-yellow-600">
                            <i class="fa fa-save mr-2"></i> Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script pour afficher les bons selects --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const structureSelect = document.getElementById('structure');
            const hopitalDiv = document.getElementById('select_hopital');
            const mairieDiv = document.getElementById('select_mairie');
            const hopitalSelect = document.getElementById('hopital_select');
            const mairieSelect = document.getElementById('mairie_select');

            function toggleStructureFields() {
                const selected = structureSelect.value;
                if (selected === 'hopital') {
                    hopitalDiv.style.display = 'block';
                    hopitalSelect.disabled = false;
                    mairieDiv.style.display = 'none';
                    mairieSelect.disabled = true;
                } else if (selected === 'mairie') {
                    hopitalDiv.style.display = 'none';
                    hopitalSelect.disabled = true;
                    mairieDiv.style.display = 'block';
                    mairieSelect.disabled = false;
                } else {
                    hopitalDiv.style.display = 'none';
                    mairieDiv.style.display = 'none';
                    hopitalSelect.disabled = true;
                    mairieSelect.disabled = true;
                }
            }

            structureSelect.addEventListener('change', toggleStructureFields);
            toggleStructureFields(); // Initialisation
        });
    </script>
</div>
@endsection