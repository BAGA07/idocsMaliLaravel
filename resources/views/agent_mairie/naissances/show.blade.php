@extends('layouts.app')

@section('content')

{{-- Conteneur de l'acte de naissance à imprimer --}}
{{-- <div class="max-w-3xl mx-auto bg-white p-6 font-serif text-sm border border-black print:p-4 print:w-full print:max-w-full print:border-none print:shadow-none relative">
     --}}
    {{-- //Mon nouveau methode pour imprimer l'acte --}}
    @section('content')
<style>
    @media print {
        /* Masquer tous les éléments du corps de la page par défaut */
        body * {
            visibility: hidden;
        }
        /* Rendre l'acte visible et le centrer */
        .acte-imprimable, .acte-imprimable * {
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
<div
    class="acte-imprimable max-w-3xl mx-auto bg-white border border-black p-6 font-serif text-sm print:p-4 print:w-full print:max-w-full print:border-none print:shadow-none relative">

    {{-- Cachet de l'officier en filigrane sur le côté (pour simuler celui de la photo) --}}
    <div class="absolute inset-y-0 left-0 w-16 h-full opacity-20 transform -translate-x-1/2 -rotate-90 origin-bottom-left print:block" style="writing-mode: vertical-rl;">
        <p class="text-[12px] font-bold tracking-wider text-center flex items-center justify-center h-full">L'OFFICIER D'ÉTAT CIVIL</p>
        {{-- Vous pouvez remplacer ce texte par une image semi-transparente de votre cachet si vous en avez une --}}
    </div>

    {{-- En-tête du document --}}
    <div class="flex justify-between items-start mb-4 relative z-10">
        <div class="text-left w-1/2">
            <div class="font-bold text-lg mb-1">AN</div>
            <p class="uppercase font-bold">République du Mali</p>
            <p class="italic text-xs">Un Peuple - Un But - Une Foi</p>
        </div>
        <div class="text-right w-1/2">
            <p class="font-bold">Acte de naissance</p>
            <p class="text-xs">N° <span class="text-blue-700 font-bold text-sm">{{ $acte->num_acte }}</span></p>
            <p class="text-xs">VOLET N°<span class="text-blue-700 font-bold text-sm">3</span></p>
            <p class="text-xs italic">(Original remis au déclarant)</p>
        </div>
    </div>

    {{-- Informations de la commune --}}
    <div class="grid grid-cols-2 gap-2 mb-2 relative z-10">
        <div class="space-y-1">
            <p><strong>RÉGION DE :</strong> <span class="uppercase font-bold text-blue-700">{{ $acte->Commune->region ?? '...' }}</span></p>
            <p><strong>CERCLE DE :</strong> <span class="uppercase font-bold text-blue-700">{{ $acte->Commune->cercle ?? '...' }}</span></p>
            <p><strong>COMMUNE DE :</strong> <span class="uppercase font-bold text-blue-700">{{ $acte->Commune->nom_commune ?? '...' }}</span></p>
            <p><strong>CENTRE :</strong> <span class="uppercase font-bold text-blue-700">Principal</span></p>
            <p><strong>DE :</strong> <span class="uppercase font-bold text-blue-700">La Commune IV</span></p>
        </div>
        <div class="text-right flex flex-col justify-between">
            <div>
                <p>NINA</p>
                <div class="border border-black w-full h-8 flex justify-end">
                    <div class="border-l border-black w-1/3"></div>
                    <div class="border-l border-black w-1/3"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- CADRE ENFANT --}}
    <div class="border border-black mx-2 mb-2 flex relative z-10">
        <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
            <p class="font-bold text-[10px] tracking-wider">ENFANT</p>
        </div>
        <div class="flex-1 p-2 space-y-1">
            <p><strong>1. Date de naissance :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ \Carbon\Carbon::parse($acte->date_naissance_enfant)->translatedFormat('d F Y') }}</span></p>
            <p><strong>2. Heure de naissance :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->heure_naissance ?? '...' }}</span></p>
            <p><strong>3. Prénom(s) :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->prenom }}</span></p>
            <p><strong>4. Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->nom }}</span></p>
            <p><strong>5. Sexe :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->sexe_enfant }}</span></p>
            <p><strong>6. Localité ou pays de naissance :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->lieu_naissance_enfant }}</span></p>
        </div>
    </div>
    
    {{-- CADRE PÈRE --}}
    <div class="border border-black mx-2 mb-2 flex relative z-10">
        <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
            <p class="font-bold text-[10px] tracking-wider">PÈRE</p>
        </div>
        <div class="flex-1 p-2 space-y-1">
            <p><strong>7. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->prenom_pere }} {{ $acte->nom_pere }}</span></p>
            <p><strong>8. Âge :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->demande->volet->age_pere ?? '...' }} ans</span></p>
            <p><strong>9. Domicile :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->domicile_pere }}</span></p>
            <p><strong>10. Profession :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->profession_pere }}</span></p>
        </div>
    </div>

    {{-- CADRE MÈRE --}}
    <div class="border border-black mx-2 mb-2 flex relative z-10">
        <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
            <p class="font-bold text-[10px] tracking-wider">MÈRE</p>
        </div>
        <div class="flex-1 p-2 space-y-1">
            <p><strong>11. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->prenom_mere }} {{ $acte->nom_mere }}</span></p>
            <p><strong>12. Âge :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->demande->volet->age_mere  ?? '...' }} ans</span></p>
            <p><strong>13. Domicile :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->domicile_mere }}</span></p>
            <p><strong>14. Profession :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->profession_mere }}</span></p>
        </div>
    </div>
    
    {{-- CADRE DÉCLARANT --}}
    {{-- <div class="border border-black mx-2 mb-2 flex relative z-10">
        <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
            <p class="font-bold text-[10px] tracking-wider">DÉCLARANT</p>
        </div>
        <div class="flex-1 p-2 space-y-1">
            <p><strong>15. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->declarant->prenom_declarant ?? '...' }} {{ $acte->declarant->nom_declarant ?? '...' }}</span></p>
            <p><strong>16. Âge :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->declarant->age_declarant ?? '...' }} ans</span></p>
            <p><strong>17. Domicile :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->declarant->domicile_declarant ?? '...' }}</span></p>
            <p><strong>18. Profession :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->declarant->profession_declarant ?? '...' }}</span></p>
            <p><strong>19. N° de la déclaration et date :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->declarant->numero_declaration ?? '...' }} du {{ \Carbon\Carbon::parse($acte->declarant->date_declaration)->format('d/m/Y') }}</span></p>
            <p><strong>20. Centre de l'hôpital ou district :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->lieu_naissance_enfant ?? '...' }}</span></p>
        </div>
    </div> --}}
    <div class="border border-black mx-2 mb-2 flex relative z-10">
    <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
        <p class="font-bold text-[10px] tracking-wider">DÉCLARANT</p>
    </div>
    <div class="flex-1 p-2 space-y-1">
        <p><strong>15. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">
            {{ $acte->declarant->prenom_declarant ?? '...' }} {{ $acte->declarant->nom_declarant ?? '...' }}
        </span></p>
        <p><strong>16. Âge :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">
            {{ $acte->declarant->age_declarant ?? '...' }} ans
        </span></p>
        <p><strong>17. Domicile :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">
            {{ $acte->declarant->domicile_declarant ?? '...' }}
        </span></p>
        <p><strong>18. Profession :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">
            {{ $acte->declarant->profession_declarant ?? '...' }}
        </span></p>
        <p><strong>19. N° de la déclaration et date :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">
            @if($acte->declarant && $acte->declarant->numero_declaration)
                {{ $acte->declarant->numero_declaration }}
            @else
                ...
            @endif
            du
            @if($acte->declarant && $acte->declarant->date_declaration)
                {{ \Carbon\Carbon::parse($acte->declarant->date_declaration)->format('d/m/Y') }}
            @else
                ...
            @endif
        </span></p>
        <p><strong>20. Centre de l'hôpital ou district :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">
            {{ $acte->lieu_naissance_enfant ?? '...' }}
        </span></p>
    </div>
  </div>
    
    {{-- Cachet et Signature --}}
    <div class="border border-black mx-2 flex items-center mb-2 relative z-10">
        <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
            <p class="font-bold text-[10px] tracking-wider">OFFICIER</p>
        </div>
        <div class="flex-1 p-2 grid grid-cols-2 gap-4 items-center">
            <div class="space-y-1">
                <p><strong>21. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->officier->prenom ?? '...' }} {{ $acte->officier->nom ?? '...' }}</span></p>
                <p><strong>22. Qualité :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ $acte->officier->profession ?? '...' }}</span></p>
                <p><strong>23. Date :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black w-full inline-block">{{ \Carbon\Carbon::parse($acte->date_enregistrement_acte)->format('d/m/Y') }}</span></p>
            </div>
            <div class="text-center relative pt-8">
                <p class="font-bold">24. Signature et cachet de l'officier d'état civil</p>
                <div class="flex justify-center items-end mt-2 h-32">
                    @if($acte->statut === 'Finalisé')
                        <div class="absolute inset-0">
                             <div class="w-full h-full flex items-end justify-between">
                                 {{-- Cachet --}}
                                 {{-- <img src="{{ asset('images/cachet_circulaire.png') }}" alt="Cachet de la mairie" class="w-40 opacity-70 absolute left-0 bottom-0 transform -translate-x-1/4"> --}}
                                 <img src="{{ asset('images/cacher.png') }}" alt="Cachet" style="width:120px; height: auto; object-fit: contain;">
                                 {{-- Signature --}}
                                 @if($acte->signature_image)
                                     <img src="{{ $acte->signature_image }}" alt="Signature Officier" class="w-40 absolute right-0 bottom-0 transform -translate-x-1/4">
                                 @endif
                             </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- Pied de page --}}
    <div class="relative z-10">
        <p class="text-xs italic text-gray-500 mt-4">Document généré via la plateforme iDocsMali. {{-- L'authenticité peut être vérifiée en scannant le QR code sur la version web. --}}</p>
    </div>
 </div>

 {{-- Boutons et QR code non-imprimables --}}
 <div class="max-w-3xl mx-auto flex flex-col items-center gap-4 mt-6 print:hidden">
    <div class="max-w-3xl mx-auto flex justify-center items-center gap-4 mt-6 print:hidden">
    {{-- Bouton d'impression --}}
    <button onclick="window.print()"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-lg">
        Imprimer l'acte
    </button>
    
    {{-- Bouton de retour au tableau de bord --}}
    <a href="{{ route('agent.dashboard') }}"
       class="inline-flex items-center bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 shadow">
        ← Retour au Tableau de Bord
    </a>
    </div>
    {{-- Boutons d'action suppression --}}
    <button onclick="confirmDelete({{ $acte->id }})" class="text-white py-2 px-4 rounded-lg bg-red-600 hover:bg-red-700" title="Supprimer">
        Supprimer l'acte
    </button>
    
       {{-- Section QR code --}}
       {{-- @if($acte->token)
        <div class="mt-6 border-2 border-blue-600 rounded-lg p-6 bg-gray-100">
            <p class="text-center font-semibold text-blue-600 mb-2">Vérification d'authenticité</p>
            <div class="flex justify-center mb-4">
                {!! QrCode::size(120)->generate(url('/verifier-document/' . $acte->token)) !!}
            </div>
            <p class="text-center text-gray-600 text-sm">Scannez ce QR code pour vérifier l'authenticité de cet acte de naissance.</p>
        </div>
        @endif --}}
 </div> 

 {{-- Script de suppression --}}
 <script>
    function confirmDelete(acteId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet acte de naissance ? Cette action est irréversible.')) {
            let form = document.createElement('form');
            form.action = `/actes/${acteId}`;
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

</div>

{{-- Boutons et QR code non-imprimables --}}
{{-- <div class="max-w-3xl mx-auto flex flex-col items-center gap-4 mt-6 print:hidden">
    <div class="max-w-3xl mx-auto flex justify-center mt-6 print:hidden">
     <button onclick="window.print()"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-lg">
        Imprimer l'acte
     </button>
    </div>
     ... (Code pour les boutons et le QR code) ... 
</div> --}}
{{-- </div> --}}

{{-- Fin du conteneur de l'acte de naissance --}}           

@endsection