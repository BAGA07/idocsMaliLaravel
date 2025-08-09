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

    <a href="{{ route('acte.pdf', $acte->id) }}" target="_blank"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
        Télécharger l'acte (PDF)
    </a>
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

@endsection