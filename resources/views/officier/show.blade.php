@extends('layouts.app')

@section('content')
{{-- Section détails (masquée à l'impression) --}}
{{-- <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow print:hidden">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Détails de la copie/extrait</h2>
        <div class="space-x-2">
            <a href="{{ route('officier.historique') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Retour</a>
            {{-- <button onclick="window.print()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Imprimer</button> --}}
        {{-- </div>
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
</div> --}} 

{{-- Le titre doit s'afficher à l'écran pour séparer les sections, mais être masqué à l'impression --}}
{{-- <h2 class="text-2xl font-bold text-center mt-8 mb-4 print:hidden">Aperçu PDF de la copie - Le bloc à imprimer</h2> --}}
 <div class="max-w-3xl mx-auto flex flex-col items-center gap-4 mt-6 print:hidden">
    <div class="max-w-3xl mx-auto flex justify-center items-center gap-4 mt-6 print:hidden">
    
    <a href="{{ route('officier.historique') }}"
       class="inline-flex items-center bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 shadow">
        ← Retour
    </a>
    </div>
<div class="acte-imprimable max-w-3xl mx-auto bg-white border border-black font-serif text-sm print:p-4 print:w-full print:max-w-full print:border-none print:shadow-none relative">
    {{-- Main content container with a new border --}}
    <div class="border border-black p-4 print-acte-singlepage">
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

    @if($copie->token)
    <div style="position: absolute; bottom: 40px; left: 40px; z-index: 10;">
        <div style="display:inline-block; padding:0;">
            <div style="font-size:0.8em; color:#222; font-weight:bold; margin-bottom:4px; text-align:center;">Vérification</div>
            <div style="margin-bottom:4px;">
                {!! QrCode::size(60)->generate(url('/verifier-document/' . $copie->token)) !!}
            </div>
            <div style="font-size:0.7em; color:#222; text-align:center;">Scannez pour vérifier</div>
        </div>
    </div>
    @endif
</div>
    {{-- <div class="text-right text-[9px] absolute bottom-0 right-2">
        <p>Socodima tel. +223 20 22 00 19</p>
    </div> --}}

    {{-- Boutons d'action (masqués à l'impression) --}}
    {{-- <div class="flex justify-end mb-4 print:hidden" style="position: absolute; bottom: -50px; right: 0;"> 
        @if($copie->statut === 'Finalisé')
            <button onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">Imprimer</button>
        @endif
    </div> --}}

    {{-- <div class="flex items-center gap-4 mt-6 print:hidden" style="position: absolute; bottom: -100px; left: 0;"> 
        <a href="{{ route('mairie.dashboard.copies') }}"
            class="inline-flex items-center bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 shadow">
            ← Retour
        </a>
    <form action="{{ route('acte.destroy', $copie->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Supprimer</button>
    </form> 

        @if($copie->statut !== 'En attente de signature' && $copie->statut !== 'Finalisé')
        <form action="{{ route('copies.envoyer_officier', $copie->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                Envoyer à l'officier
            </button>
        </form>
        @endif
    </div>--}}
@endsection

@section('scripts')
@if(request('imprimer') == 1)
<script>
    window.onload = function() {
        window.print();
    };
</script>
@endif
<style>
@media print {
    /* Cache tous les éléments qui ne sont pas l'acte */
    body > *:not(.print-acte-singlepage) {
        display: none !important;
    }

    /* Cache spécifiquement la sidebar et la navigation */
    .fixed.inset-y-0.left-0.w-64.z-40,
    .sticky.top-0.z-30.bg-white.shadow,
    .ml-64.flex-1.min-h-screen {
        display: none !important;
    }

    /* Force le contenu principal à prendre toute la largeur */
    .print-acte-singlepage {
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
        max-width: none !important;
    }

    /* Le conteneur principal de l'acte */
    .print-acte-singlepage {
        margin: 0 !important;
        padding: 0 0 25mm 0 !important; /* Ajoute plus de padding en bas pour allonger la page */
        width: 210mm !important; /* Largeur A4 */
        height: 350mm !important; /* Hauteur pour la signature et cachet */
        max-width: none !important;
        border: none !important;
        box-shadow: none !important;
        background-color: transparent !important;
        position: relative; /* Pour positionner le contenu précisément */
        display: block !important;
        overflow: hidden !important; /* Empêche le défilement et le dépassement */
        page-break-after: avoid; /* Évite la coupure de page */
        page-break-inside: avoid; /* Évite la coupure à l'intérieur */
        font-family: 'Times New Roman', Times, serif !important;
    }

    /* Styles pour les tableaux pour avoir des bordures fines et contigües */
    table {
        border-collapse: collapse !important;
        border: none !important; /* Géré par les divs externes */
    }
    table td, table th {
        border: none !important; /* Géré par les divs externes */
        padding: 0 !important; /* Supprime le padding par défaut des cellules */
    }

    /* Ajustements pour les blocs avec bordures fines */
    .border-black {
        border-width: 1px !important;
        border-color: black !important;
    }

    /* Force dashed border for specific elements */
    .border-dashed {
        border-style: dashed !important;
    }

    /* Réinitialiser les marges et paddings par défaut pour une meilleure prévisibilité */
    p, h1, h2, h3, h4, h5, h6, div {
        margin: 0;
        padding: 0;
    }
    p {
        line-height: 1.2; /* Ajustement pour la densité du texte */
    }

    /* Spécifique pour les éléments du formulaire si présents */
    input, select, textarea {
        display: none !important; /* Cache les champs de formulaire à l'impression */
    }

    /* Adjustments for images (cachet and signature) */
    .print-acte-singlepage .absolute.bottom-2 { /* Targeting the specific signature/cachet container */
        height: 180px;
        display: flex;
        justify-content: flex-end; /* Garde l'alignement à droite */
        align-items: flex-end; /* Aligne le contenu en bas */
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        page-break-inside: avoid !important;
    }

    .print-acte-singlepage .absolute.bottom-2 > div {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    /* Styles pour le conteneur du cachet */
    .print-acte-singlepage .absolute.bottom-2 .cachet-container-print {
        /* Pousse le cachet un peu à gauche par rapport à sa position naturelle à droite */
        margin-left: -900mm !important; /* Ajustez cette valeur pour décaler le cachet vers la gauche */
        /* Si le cachet est encore trop à droite, augmentez la valeur négative (ex: -25mm) */
        /* Si le cachet est trop à gauche, diminuez la valeur négative (ex: -10mm) */

        /* Si vous voulez également le décaler de la bordure droite du papier, vous pouvez ajouter: */
        margin-right: 100mm !important; /* Décale le cachet de 5mm par rapport à la bordure droite du conteneur parent */
    }

    .print-acte-singlepage .absolute.bottom-2 img {
        display: block;
        margin-top: 5px;
    }

    /* Ajustement de la taille de la police pour être plus proche de l'original */
    .text-\[12px\] { font-size: 12px !important; }
    .text-\[11px\] { font-size: 11px !important; }
    .text-\[10px\] { font-size: 10px !important; }
    .text-\[9px\] { font-size: 9px !important; }
    .text-\[14px\] { font-size: 14px !important; }
    .text-\[18px\] { font-size: 18px !important; }

    /* Ajustements de l'espacement et du positionnement */
    .mb-1 { margin-bottom: 0.25rem !important; }
    .mb-2 { margin-bottom: 0.5rem !important; }
    .mb-3 { margin-bottom: 0.75rem !important; }
    .mb-4 { margin-bottom: 1rem !important; }
    .mt-2 { margin-top: 0.5rem !important; }
    .mt-4 { margin-top: 1rem !important; }
    .mt-6 { margin-top: 1.5rem !important; }
    .mt-8 { margin-top: 2rem !important; }

    /* Spécifique pour le pied de page Socodima */
    .text-right.text-\[9px\].absolute.bottom-0.right-2 {
        bottom: 0mm !important; /* Mettre Socodima tout en bas de la page */
        right: 5mm !important; /* Ajustez la marge droite si nécessaire */
    }

    /* Force Times New Roman for all document content */
    body {
        font-family: 'Times New Roman', Times, serif !important;
    }
}
</style>
@endsection