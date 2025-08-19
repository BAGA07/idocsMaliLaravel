@extends('layouts.app')

@section('content')
<div
    class="max-w-3xl mx-auto bg-white border border-black p-6 text-[16px] font-[Times New Roman] print:p-4 print:w-full print:max-w-full print:border-none">

    <div class="flex justify-between items-start mb-4">
        {{-- <img src="{{ asset('images/logo_mali.png') }}" alt="Logo Mali" class="w-24 h-auto"> --}}
        <div class="text-center flex-1">
            <p class="uppercase font-bold">République du Mali</p>
            <p><em>Un Peuple - Un But - Une Foi</em></p>
        </div>
        {{-- <img src="{{ asset('images/tampon_officiel.png') }}" alt="Tampon Officiel" class="w-24 h-auto"> --}}
    </div>

    <div class="grid grid-cols-2 gap-2  p-2">
        <div>
            @if($acte->Commune)
            <p><strong>RÉGION DE :</strong> {{ $acte->Commune->region ?? '...' }}</p>
            <p><strong>CERCLE DE :</strong> {{ $acte->Commune->cercle ?? '...' }}</p>
            <p><strong>COMMUNE DE :</strong> {{ $acte->Commune->nom_commune ?? '...' }}</p>
            @else
            <p><strong>RÉGION DE :</strong> ...</p>
            <p><strong>CERCLE DE :</strong> ...</p>
            <p><strong>COMMUNE DE :</strong> ...</p>
            @endif
            <p><strong>CENTRE :</strong> Principal</p>
            <p><strong>DE :</strong> La Commune IV</p>
        </div>
        <div class="text-right">
            <p><strong>Acte de naissance</strong> N° {{ $acte->num_acte }}</p>
            <p class="text-sm">(Volet N°3 – Original remis au déclarant)</p>
            <p><strong>NINA :</strong> ......................................</p>
        </div>
    </div>

    <div class="border border-black mx-2 mb-2 flex">
    {{-- CADRE ENFANT --}}
    <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black"
        style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
        <p class="font-bold text-[10px] tracking-wider">ENFANT</p>
    </div>
    <div class="flex-1 p-2">
        <div style="font-size: 11px;">
            <p class="flex items-end mb-1">
                <strong class="mr-1">1. Date de naissance :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ \Carbon\Carbon::parse($acte->date_naissance_enfant)->translatedFormat('d F Y') }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">2. Heure de naissance :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->heure_naissance ?? '...' }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">3. Prénom(s) :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->prenom }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">4. Nom :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->nom }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">5. Sexe :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->sexe_enfant }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">6. Lieu de naissance :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->lieu_naissance_enfant }}
                </span>
            </p>
        </div>
    </div>
</div>


    <div class="border border-black mx-2 mb-2 flex">
        {{-- CADRE PÈRE --}}
        <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
            <p class="font-bold text-[10px] tracking-wider">PÈRE</p>
        </div>
        <div class="flex-1 p-2">
            <div style="font-size: 11px;">
                <p class="flex items-end mb-1">
                    <strong class="mr-1">6 Prénom(s) :</strong>
                    <span class="uppercase border-b border-black flex-grow text-left px-1">
                        {{ $acte->prenom_pere }}
                    </span>
                </p>
                <p class="flex items-end mb-1">
                    <strong class="mr-1">7 Nom :</strong>
                    <span class="uppercase border-b border-black flex-grow text-left px-1">
                        {{ $acte->nom_pere }}
                    </span>
                </p>
                <p class="flex items-end mb-1">
                    <strong class="mr-1">8 Profession :</strong>
                    <span class="uppercase border-b border-black flex-grow text-left px-1">
                        {{ $acte->profession_pere }}
                    </span>
                </p>
                <p class="flex items-end mb-1">
                    <strong class="mr-1">9 Domicile :</strong>
                    <span class="uppercase border-b border-black flex-grow text-left px-1">
                        {{ $acte->domicile_pere }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="border border-black mx-2 mb-2 flex">
        {{-- CADRE MÈRE --}}
        <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
            <p class="font-bold text-[10px] tracking-wider">MÈRE</p>
        </div>
        <div class="flex-1 p-2">
            <div style="font-size: 11px;">
                <p class="flex items-end mb-1">
                    <strong class="mr-1">10 Prénom(s) :</strong>
                    <span class="uppercase border-b border-black flex-grow text-left px-1">
                        {{ $acte->prenom_mere }}
                    </span>
                </p>
                <p class="flex items-end mb-1">
                    <strong class="mr-1">11 Nom :</strong>
                    <span class="uppercase border-b border-black flex-grow text-left px-1">
                        {{ $acte->nom_mere }}
                    </span>
                </p>
                <p class="flex items-end mb-1">
                    <strong class="mr-1">12 Profession :</strong>
                    <span class="uppercase border-b border-black flex-grow text-left px-1">
                        {{ $acte->profession_mere }}
                    </span>
                </p>
                <p class="flex items-end mb-1">
                    <strong class="mr-1">13 Domicile :</strong>
                    <span class="uppercase border-b border-black flex-grow text-left px-1">
                        {{ $acte->domicile_mere }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="border border-black mx-2 mb-2 flex">
    {{-- CADRE DÉCLARANT --}}
    <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black"
        style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
        <p class="font-bold text-[10px] tracking-wider">DÉCLARANT</p>
    </div>
    <div class="flex-1 p-2">
        <div style="font-size: 11px;">
            <p class="flex items-end mb-1">
                <strong class="mr-1">15. Nom :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->declarant->nom_declarant ?? '...' }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">16. Âge :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->declarant->age_declarant ?? '...' }} ans
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">17. Domicile :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->declarant->domicile_declarant ?? '...' }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">18. Profession :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->declarant->profession_declarant ?? '...' }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">19. N° de déclaration et date :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    @if($acte->declarant)
                        {{ $acte->declarant->numero_declaration ?? '...' }} du 
                        {{ \Carbon\Carbon::parse($acte->declarant->date_declaration)->format('d/m/Y') }}
                    @else
                        ...
                    @endif
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">20. Centre :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->lieu_naissance_enfant ?? '...' }}
                </span>
            </p>
        </div>
    </div>
</div>

   <div class="border border-black mx-2 mb-2 flex">
    {{-- Étiquette verticale OFFICIER --}}
    <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black"
        style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
        <p class="font-bold text-[10px] tracking-wider">OFFICIER</p>
    </div>

    {{-- Contenu --}}
    <div class="flex-1 p-2" style="font-size: 11px;">
        @if($acte->officier)
            <p class="flex items-end mb-1">
                <strong class="mr-1">21. Officier d'état civil :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->officier->nom ?? '...' }}
                </span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">22. Qualité :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">
                    {{ $acte->officier->profession ?? '...' }}
                </span>
            </p>
        @else
            <p class="flex items-end mb-1">
                <strong class="mr-1">21. Officier d'état civil :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">...</span>
            </p>
            <p class="flex items-end mb-1">
                <strong class="mr-1">22. Qualité :</strong>
                <span class="uppercase border-b border-black flex-grow text-left px-1">...</span>
            </p>
        @endif
        <p class="flex items-end mb-1">
            <strong class="mr-1">23. Date :</strong>
            <span class="uppercase border-b border-black flex-grow text-left px-1">
                {{ \Carbon\Carbon::parse($acte->date_enregistrement_acte)->format('d/m/Y') }}
            </span>
        </p>
    </div>
</div>

    <div class="mt-10 relative h-32 print-pagebreak-avoid">
        <p class="text-right font-semibold">24. Signature et cachet de l'officier d'état civil</p>
        @if($acte->statut === 'Finalisé')
            <div class="flex flex-row items-end justify-end mt-2 gap-4" style="align-items: center; margin-top: -20px;">
                @if($acte->signature_image)
                    <img src="{{ $acte->signature_image }}" alt="Signature Officier" style="width:140px; border:1px solid #ccc; align-self:center; margin-bottom:0; margin-top:0;">
                @endif
                <img src="{{ asset('images/cacher.png') }}" alt="Cachet" style="width:150px; margin-bottom: 5px;">
            </div>
        @elseif($acte->statut === 'À finaliser')
        <p class="text-right text-yellow-700 font-semibold mt-2">En attente de finalisation par l'officier</p>
        @else
        <p class="text-right text-gray-500 font-semibold mt-2">Acte en cours de traitement</p>
        @endif
        <br>
    </div>

    {{--- Section du QR code d'authenticité ---}}
    <div class="flex flex-col items-center gap-4 mt-6 print:hidden">
        {{-- La condition @if($acte->token) vérifie si un token d'authenticité est bien présent pour cet acte.
             Le QR code ne sera généré que si le token existe. Si le token est absent, rien ne s'affichera ici. --}}
        @if($acte->token)
            {{-- Conteneur stylisé pour le QR code et son message --}}
            <div class="mt-6 border-2 border-blue-600 rounded-lg p-6 bg-gray-100">
                <p class="text-center font-semibold text-blue-600 mb-2">Vérification d'authenticité</p>
                <div class="flex justify-center mb-4">
                    {{-- La fonction QrCode::size()->generate() est utilisée pour créer le QR code.
                         Elle prend en paramètre l'URL vers laquelle le QR code doit pointer.
                         Ici, c'est l'URL de vérification de document, incluant le token unique de l'acte. --}}
                    {!! QrCode::size(120)->generate(url('/verifier-document/' . $acte->token)) !!}
                </div>
                <p class="text-center text-gray-600 text-sm">Scannez ce QR code pour vérifier l'authenticité de cet acte de naissance.</p>
            </div>
        @endif {{-- Fin de la condition @if($acte->token) --}}
    </div>

</div> {{-- Fin du conteneur principal de l'acte --}}

<div class="max-w-3xl mx-auto flex justify-center items-center gap-4 mt-6 print:hidden">
    <a href="{{ route('agent.dashboard') }}"
        class="inline-flex items-center bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 shadow">
        ← Retour au Tableau de Bord
    </a>

    {{-- Assurez-vous que l'ID passé à confirmDelete est le bon ID de l'acte, pas id_volet si ce n'est pas le cas --}}
    <button onclick="confirmDelete({{ $acte->id }})"
            class="text-white py-2 px-4 rounded-lg bg-red-600 hover:bg-red-700" title="Supprimer">
            Supprimer l'acte
    </button>

    {{-- <a href="{{ route('acte.pdf', $acte->id) }}" target="_blank"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
        Télécharger l'acte (PDF)
    </a> --}}
</div>

{{-- Script pour la confirmation de suppression, si ce n'est pas déjà dans un fichier JS externe --}}
<script>
    function confirmDelete(acteId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet acte de naissance ? Cette action est irréversible.')) {
            // Créer un formulaire temporaire pour envoyer la requête DELETE
            let form = document.createElement('form');
            form.action = `/actes/${acteId}`; // Assurez-vous que cette route correspond à votre route destroy
            form.method = 'POST';
            form.style.display = 'none';

            let csrfInput = document.createElement('input');
            csrfInput.setAttribute('type', 'hidden');
            csrfInput.setAttribute('name', '_token', '{{ csrf_token() }}');
            form.appendChild(csrfInput);

            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method', 'DELETE');
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

{{-- Bouton PDF --}}
{{-- <div class="text-center mb-4">
    <a href="{{ route('acte.pdf', $acte->id) }}" target="_blank"
        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
        Télécharger l'acte (PDF)
    </a>
</div> --}}

{{-- QR code d'authenticité --}}
@if($acte->token)
<div class="flex justify-center mb-6">
    <div class="border-2 border-blue-600 rounded-lg p-6 bg-gray-100">
        <p class="text-center font-semibold text-blue-600 mb-2">Vérification d'authenticité</p>
        <div class="flex justify-center mb-4">
            {!! QrCode::size(120)->generate(url('/verifier-document/' . $acte->token)) !!}
        </div>
        <p class="text-center text-gray-600 text-sm">Scannez ce QR code pour vérifier l'authenticité de cet acte de
            naissance.</p>
    </div>
</div>
@endif

{{-- Suppression
<form action="{{ route('acte.destroy', $acte->id) }}" method="POST"
    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet acte ?');" class="text-center">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
        Supprimer cet acte
    </button>
</form> --}}

</div>
@endsection