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

    <div class="grid grid-cols-2 gap-2 border border-black p-2">
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

    <div class="border border-black mt-3 p-2">
        <p><strong>1. Date de naissance :</strong> {{
            \Carbon\Carbon::parse($acte->date_naissance_enfant)->translatedFormat('d F Y') }}</p>
        <p><strong>2. Heure de naissance :</strong> {{ $acte->heure_naissance ?? '...' }}</p>
        <p><strong>3. Prénom(s) :</strong> {{ $acte->prenom }}</p>
        <p><strong>4. Nom :</strong> {{ $acte->nom }}</p>
        <p><strong>5. Sexe :</strong> {{ $acte->sexe_enfant }}</p>
        <p><strong>6. Lieu de naissance :</strong> {{ $acte->lieu_naissance_enfant }}</p>
    </div>

    <div class="border border-black mt-3 p-2">
        <p><strong>7. Nom du père :</strong> {{ $acte->nom_pere }}</p>
        {{-- {{ dd($acte->demande->volet) }} --}}
        <p><strong>8. Âge :</strong>
            @if($acte->demande && $acte->demande->volet)
                {{ $acte->demande->volet->age_pere ?? '...' }} ans
            @else
                ...
            @endif
        </p>
        <p><strong>9. Domicile :</strong> {{ $acte->domicile_pere }}</p>
        <p><strong>10. Profession :</strong> {{ $acte->profession_pere }}</p>
    </div>

    <div class="border border-black mt-3 p-2">
        <p><strong>11. Nom de la mère :</strong> {{ $acte->nom_mere }}</p>
        <p><strong>12. Âge :</strong>
            @if($acte->demande && $acte->demande->volet)
                {{ $acte->demande->volet->age_mere ?? '...' }} ans
            @else
                ...
            @endif
        </p>
        <p><strong>13. Domicile :</strong> {{ $acte->domicile_mere }}</p>
        <p><strong>14. Profession :</strong> {{ $acte->profession_mere }}</p>
    </div>

    <div class="border border-black mt-3 p-2">
        @if($acte->declarant)
            <p><strong>15. Déclarant :</strong> {{ $acte->declarant->nom_declarant ?? '...' }}</p>
            <p><strong>16. Âge :</strong> {{ $acte->declarant->age_declarant ?? '...' }} ans</p>
            <p><strong>17. Domicile :</strong> {{ $acte->declarant->domicile_declarant ?? '...' }}</p>
            <p><strong>18. Profession :</strong> {{ $acte->declarant->profession_declarant ?? '...' }}</p>
        @else
            <p><strong>15. Déclarant :</strong> ...</p>
            <p><strong>16. Âge :</strong> ...</p>
            <p><strong>17. Domicile :</strong> ...</p>
            <p><strong>18. Profession :</strong> ...</p>
        @endif
    </div>

    <div class="border border-black mt-3 p-2">
        <p><strong>19. N° de déclaration et date :</strong>
            @if($acte->declarant)
                {{ $acte->declarant->numero_declaration ?? '...' }} du {{ \Carbon\Carbon::parse($acte->declarant->date_declaration)->format('d/m/Y') }}
            @else
                ...
            @endif
        </p>
        <p><strong>20. Centre :</strong> {{ $acte->lieu_naissance_enfant }}</p>
    </div>

    <div class="border border-black mt-3 p-2">
        @if($acte->officier)
            <p><strong>21. Officier d'état civil :</strong> {{ $acte->officier->nom ?? '...' }}</p>
            {{-- {{ $acte->officier->Mairie->nom_mairie ?? '...' }} --}}
            <p><strong>22. Qualité :</strong> {{ $acte->officier->profession ?? '...' }} </p>
        @else
            <p><strong>21. Officier d'état civil :</strong> ...</p>
            <p><strong>22. Qualité :</strong> ...</p>
        @endif
        <p><strong>23. Date :</strong> {{ \Carbon\Carbon::parse($acte->date_enregistrement_acte)->format('d/m/Y') }}</p>
    </div>

    <div class="mt-10 relative h-32 print-pagebreak-avoid">
        <p class="text-right font-semibold">24. Signature et cachet de l'officier d'état civil</p>
        @if($acte->statut === 'Finalisé')
            <div class="flex flex-row items-end justify-end mt-2 gap-4" style="align-items: center; margin-top: -20px;"> {{-- Adjusted margin-top here --}}
                @if($acte->signature_image)
                    {{-- Assurez-vous que l'image de signature est un PNG avec fond transparent --}}
                    <img src="{{ $acte->signature_image }}" alt="Signature Officier" style="width:120px; border:1px solid #ccc; align-self:center; margin-bottom:0; margin-top:0;">
                @endif
                <img src="{{ asset('images/cacher.png') }}" alt="Cachet" style="width:120px; margin-bottom: 5px;"> {{-- Increased width --}}
            </div>
        @elseif($acte->statut === 'À finaliser')
            <p class="text-right text-yellow-700 font-semibold mt-2">En attente de finalisation par l'officier</p>
        @else
            <p class="text-right text-gray-500 font-semibold mt-2">Acte en cours de traitement</p>
        @endif
        <br>
    </div>

</div> {{-- Fin du conteneur de l'acte --}}
<br>
{{-- Nouvelle section pour les boutons, en dehors du conteneur de l'acte --}}
<div class="max-w-3xl mx-auto flex items-center gap-4 mt-6 print:hidden">
    <a href="{{ route('agent.dashboard') }}"
        class="inline-flex items-center bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 shadow">
        ← Retour
    </a>

    <button onclick="confirmDelete({{ $acte->id_volet }})"
            class="text-white-100 py-2 px-4 rounded-lg bg-red-600 hover:bg-red-700 mx-1" title="Supprimer">
            Supprimer
    </button>

    {{-- Optionnel: Bouton de téléchargement PDF si vous en avez un --}}
    {{-- <form action="{{ route('acte.download', $acte->id) }}" method="GET">
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Télécharger en PDF
        </button>
    </form> --}}
</div>

@endsection