@extends('layouts.app')

@section('content')
{{-- Section détails (masquée à l'impression) --}}
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow print:hidden">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Détails de la copie/extrait</h2>
        <div class="space-x-2">
            <a href="{{ route('mairie.dashboard.copies') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Retour</a>
            <button onclick="window.print()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Imprimer</button>
        </div>
    </div>

    <div class="bg-gray-50 p-4 rounded mb-6">
        <h3 class="text-lg font-semibold mb-4">Informations générales</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p><strong>Numéro d'acte :</strong> {{ $copie->num_acte }}</p>
                <p><strong>Statut :</strong>
                    @if($copie->statut)
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            @if($copie->statut == 'En attente de signature') bg-yellow-100 text-yellow-800
                            @elseif($copie->statut == 'Finalisé') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $copie->statut }}
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Traité</span>
                    @endif
                </p>
                <p><strong>Type :</strong> {{ $copie->type ?? 'Copie' }}</p>
            </div>
            <div>
                <p><strong>Date d'enregistrement :</strong> {{ $copie->date_enregistrement_acte }}</p>
                <p><strong>Commune :</strong> {{ $copie->Commune->nom_commune ?? 'Non renseigné' }}</p>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 p-4 rounded mb-6">
        <h3 class="text-lg font-semibold mb-4">Informations de l'enfant</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p><strong>Prénom :</strong> {{ $copie->prenom }}</p>
                <p><strong>Nom :</strong> {{ $copie->nom }}</p>
                <p><strong>Date de naissance :</strong> {{ $copie->date_naissance_enfant }}</p>
            </div>
            <div>
                <p><strong>Lieu de naissance :</strong> {{ $copie->lieu_naissance_enfant }}</p>
                <p><strong>Heure de naissance :</strong> {{ $copie->heure_naissance }}</p>
                <p><strong>Sexe :</strong> {{ $copie->sexe_enfant == 'M' ? 'Masculin' : 'Féminin' }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-gray-50 p-4 rounded">
            <h3 class="text-lg font-semibold mb-4">Informations du père</h3>
            <p><strong>Prénom :</strong> {{ $copie->prenom_pere }}</p>
            <p><strong>Nom :</strong> {{ $copie->nom_pere }}</p>
            <p><strong>Profession :</strong> {{ $copie->profession_pere }}</p>
            <p><strong>Domicile :</strong> {{ $copie->domicile_pere }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded">
            <h3 class="text-lg font-semibold mb-4">Informations de la mère</h3>
            <p><strong>Prénom :</strong> {{ $copie->prenom_mere }}</p>
            <p><strong>Nom :</strong> {{ $copie->nom_mere }}</p>
            <p><strong>Profession :</strong> {{ $copie->profession_mere }}</p>
            <p><strong>Domicile :</strong> {{ $copie->domicile_mere }}</p>
        </div>
    </div>

    @if($copie->demande)
    <div class="bg-gray-50 p-4 rounded mt-6">
        <h3 class="text-lg font-semibold mb-4">Informations de la demande</h3>
        <p><strong>Type de document :</strong> {{ $copie->demande->type_document }}</p>
        <p><strong>Statut de la demande :</strong> {{ $copie->demande->statut }}</p>
        <p><strong>Date de création :</strong> {{ $copie->demande->created_at }}</p>
    </div>
    @endif
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .acte-imprimable,
        .acte-imprimable * {
            visibility: visible;
        }

        .acte-imprimable {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
    }
</style>

{{-- Section acte imprimable --}}
<div class="acte-imprimable max-w-3xl mx-auto bg-white border border-black font-serif text-sm print:p-4 print:w-full print:max-w-full print:border-none print:shadow-none relative">
    {{-- Main content container with a new border --}}
    <div class="border border-black p-4">
        <div class="mb-4">
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="text-left w-1/2">
                    <div class="flex-1 space-y-1">
                        <p><strong>RÉGION DE :</strong> <span class="uppercase font-bold">{{ $copie->Commune->region ?? '...' }}</span></p>
                        <p><strong>CERCLE DE :</strong> <span class="uppercase font-bold">{{ $copie->Commune->cercle ?? '...' }}</span></p>
                        <p><strong>ARRONDISSEMENT DE :</strong> <span class="uppercase font-bold">{{ $copie->Commune->nom_commune ?? '...' }}</span></p>
                        <p><strong>CENTRE :</strong> <span class="uppercase font-bold">SECONDAIRE</span></p>
                    </div>
                </div>
                <div class="text-right w-1/2">
                    <p class="uppercase font-bold">République du Mali</p>
                    <p class="italic text-xs">Un Peuple - Un But - Une Foi</p>
                </div>
            </div>

            <div class="flex-1 text-center">
                <p class="font-bold text-lg mb-1">COPIE D'EXTRAIT DE L'ACTE DE NAISSANCE N° {{ $copie->num_acte }}</p>
                <div class="flex items-center justify-center">
                    <p class="mr-2">NINA</p>
                    <div class="border border-black w-32 h-5 flex justify-around">
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="border-r border-black flex-grow"></div>
                        <div class="flex-grow"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CADRE ENFANT --}}
        <div class="border border-black mx-2 mb-2 flex">
            <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg); background-color: hsla(0, 93%, 6%, 0.10);">
                <p class="font-bold text-[10px] tracking-wider">ENFANT</p>
            </div>
            <div class="flex-1 p-2 space-y-1">
                <p class="flex items-end mb-1"><strong>3. Prénom(s) :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->prenom }}</span></p>
                <p class="flex items-end mb-1"><strong>4. Nom :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->nom }}</span></p>
                <p class="flex items-end mb-1"><strong>1. Date de naissance :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ \Carbon\Carbon::parse($copie->date_naissance)->translatedFormat('d F Y') }}</span></p>
                <p class="flex items-end mb-1"><strong>6. Localité ou pays de naissance :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->lieu_naissance }}</span></p>
                <p class="flex items-end mb-1"><strong>5. Sexe :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->sexe == 'M' ? 'MASCULIN' : 'FÉMININ' }}</span></p>
            </div>
        </div>
        {{-- CADRE PÈRE --}}
        <div class="border border-black mx-2 mb-2 flex">
            <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg); background-color: hsla(0, 93%, 6%, 0.10);">
                <p class="font-bold text-[10px] tracking-wider">PÈRE</p>
            </div>
            <div class="flex-1 p-2 space-y-1">
                <p class="flex items-end mb-1"><strong>3. Prénom(s) :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->prenom_pere }}</span></p>
                <p class="flex items-end mb-1"><strong>4. Nom :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->nom_pere }}</span></p>
                <p class="flex items-end mb-1"><strong>9. Domicile :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->domicile_pere }}</span></p>
                <p class="flex items-end mb-1"><strong>10. Profession :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->profession_pere }}</span></p>
            </div>
        </div>
        {{-- CADRE MÈRE --}}
        <div class="border border-black mx-2 mb-2 flex">
            <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg); background-color: hsla(0, 93%, 6%, 0.10);">
                <p class="font-bold text-[10px] tracking-wider">MÈRE</p>
            </div>
            <div class="flex-1 p-2 space-y-1">
                <p class="flex items-end mb-1"><strong>3. Prénom(s) :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->prenom_mere }}</span></p>
                <p class="flex items-end mb-1"><strong>4. Nom :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->nom_mere }}</span></p>
                <p class="flex items-end mb-1"><strong>9. Domicile :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->domicile_mere }}</span></p>
                <p class="flex items-end mb-1"><strong>10. Profession :</strong> <span class="uppercase border-b border-black flex-grow text-left px-1">{{ $copie->profession_mere }}</span></p>
            </div>
        </div>

        <div class="border border-black p-2 mx-2 mb-2">
            <p class="flex items-end mb-1">
                <strong class="mr-1">14 Prénom(s) et Nom de l'Officier de l'état civil :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $copie->officier->nom ?? 'MR ADAMA DOUMBIA' }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">15 Qualité :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $copie->qualite_officier ?? 'OFFICIER D\'ETAT CIVIL' }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">16 Date d'établissement de l'acte :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $copie->date_etablissement ? \Carbon\Carbon::parse($copie->date_etablissement)->format('d/m/Y') : '' }}
                </span>
            </p>
        </div>

        <div class="border border-black p-2 mx-2 mb-2">
            <p class="mb-1">
                <strong>Certifié le présent extrait conforme à l'original n° :</strong>
                <span class="uppercase border-b border-black border-dashed px-1">{{ $copie->num_acte }}</span>
                année
                <span class="uppercase border-b border-black border-dashed px-1">{{ \Carbon\Carbon::parse($copie->date_naissance)->format('Y') }}</span>
            </p>
            <p class="mb-1">
                <strong>du Centre :</strong>
                <span class="uppercase border-b border-black border-dashed px-1">PRINCIPAL</span>
                de
                <span class="uppercase border-b border-black border-dashed px-1">{{ $copie->lieu_naissance }}</span>
            </p>
            <p class="mb-1">
                <strong>Prénom(s), Nom et Qualité :</strong>
                <span class="uppercase border-b border-black border-dashed px-1">MR ALEXIS DIARRA</span>
            </p>
            <p class="mb-1">
                <strong>Officier de l'état civil du Centre :</strong>
                <span class="uppercase border-b border-black border-dashed px-1">SECONDAIRE NIAMAKORO</span>
            </p>
            <p>
                <strong>Date :</strong>
                <span class="uppercase border-b border-black border-dashed px-1">{{ $copie->date_delivrance ? \Carbon\Carbon::parse($copie->date_delivrance)->format('d/m/Y') : \Carbon\Carbon::now()->format('d/m/Y') }}</span>
            </p>

            <div class="flex justify-end mt-4">
                @if($copie->statut === 'Finalisé')
                    <div class="flex items-center gap-4">
                        <div class="flex flex-col items-center text-center">
                            <p class="font-bold text-[10px] mt-auto">L'OFFICIER DE L'ÉTAT CIVIL</p>
                            @if($copie->signature_image)
                                <img src="{{ $copie->signature_image }}" alt="Signature Officier" style="width:100px; height: auto; object-fit: contain; margin-top: 5px;">
                            @endif
                        </div>
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/cacher.png') }}" alt="Cachet" style="width:120px; height: auto; object-fit: contain;">
                        </div>
                    </div>
                @elseif($copie->statut === 'En attente de signature')
                    <p class="font-semibold text-[11px]">En attente de signature de l'officier</p>
                @else
                    <p class="font-semibold text-[11px]">Copie en cours de traitement</p>
                @endif
            </div>
        </div>
    </div>
</div>
    {{-- Boutons et QR code non-imprimables --}}
    <div class="max-w-3xl mx-auto flex flex-col items-center gap-4 mt-6 print:hidden">
        <div class="max-w-3xl mx-auto flex justify-center items-center gap-4 mt-6 print:hidden">
            {{-- Bouton d'impression --}}
            <button onclick="window.print()" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-lg">
                Imprimer l'acte
            </button>
            {{-- Bouton de retour au tableau de bord --}}
            <a href="{{ route('agent.dashboard') }}" class="inline-flex items-center bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 shadow">
                ← Retour au Tableau de Bord
            </a>
        </div>
    </div>
</div>

@endsection