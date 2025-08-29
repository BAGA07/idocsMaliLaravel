@extends('layouts.app')

@section('content')

<style>
    @page {
        size: A4 portrait;
        margin: 10mm;
    }
    @media print {
        body * {
            visibility: hidden;
            margin: 0;
            padding: 0;
        }
        .acte-imprimable, .acte-imprimable * {
            visibility: visible;
        }
        .acte-imprimable {
            position: absolute;
            left: 50%;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            /* Key change: Scale down the document for printing */
            transform: translateX(-50%) scale(0.85);
            transform-origin: top center;
            break-inside: avoid-page;
            page-break-inside: avoid;
            page-break-before: avoid;
            page-break-after: avoid;
            zoom: 0.85;
        }
        .acte-imprimable .border {
            border-width: 1px !important;
        }
        .print-break-avoid {
            break-inside: avoid;
        }
        .print-acte-singlepage {
            break-inside: avoid-page;
            page-break-inside: avoid;
            page-break-before: avoid;
            page-break-after: avoid;
            display: inline-block;
        }
    }
</style>

<div class="acte-imprimable max-w-3xl mx-auto bg-white border border-black font-serif text-sm print:p-2 print:w-full print:max-w-full print:border-none print:shadow-none relative">
    {{-- Main content container with a new border --}}
    <div class="border border-black p-4 print:p-2 print-acte-singlepage">
        {{-- Cachet de l'officier en filigrane --}}
        <div class="absolute inset-y-0 left-0 w-16 h-full opacity-20 transform -translate-x-1/2 -rotate-90 origin-bottom-left print:block" style="writing-mode: vertical-rl;">
            <p class="text-[12px] font-bold tracking-wider text-center flex items-center justify-center h-full">L'OFFICIER D'ÉTAT CIVIL</p>
        </div>

        {{-- En-tête du document --}}
        <div class="flex justify-between items-start mb-4 relative z-10">
            <div class="text-left w-1/2">
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
        <div class="grid grid-cols-2 gap-2 mb-2 relative z-10 print-break-avoid">
            <div class="space-y-1">
                <p class="flex items-end mb-1"><strong>RÉGION DE :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black text-left px-1">{{ $acte->Commune->region ?? '...' }}</span></p>
                <p class="flex items-end mb-1"><strong>CERCLE DE :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black text-left px-1">{{ $acte->Commune->cercle ?? '...' }}</span></p>
                <p class="flex items-end mb-1"><strong>COMMUNE DE :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black text-left px-1">{{ $acte->Commune->nom_commune ?? '...' }}</span></p>
                <p class="flex items-end mb-1"><strong>CENTRE :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black text-left px-1">Principal</span></p>
                <p class="flex items-end mb-1"><strong>DE :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black text-left px-1">La Commune IV</span></p>
            </div>
            <div class="text-right flex flex-col justify-between">
                <div class="text-center">
                    <p class="mb-1">NINA</p>
                    <div class="border border-black w-32 h-5 flex justify-around mx-auto">
                        <div class="border-r border-black w-[20%]"></div>
                        <div class="border-r border-black w-[20%]"></div>
                        <div class="border-r border-black w-[20%]"></div>
                        <div class="border-r border-black w-[20%]"></div>
                        <div class="border-r border-black w-[20%]"></div>
                        <div class="w-[20%]"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CADRE ENFANT --}}
        <div class="border border-black mx-2 mb-2 flex relative z-10 print-break-avoid">
            <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg); background-color: hsla(0, 93%, 6%, 0.10);">
                <p class="font-bold text-[10px] tracking-wider">ENFANT</p>
            </div>
            <div class="flex-1 p-2 space-y-1">
                <p class="flex items-end mb-1"><strong>1. Date de naissance :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ \Carbon\Carbon::parse($acte->date_naissance_enfant)->translatedFormat('d F Y') }}</span></p>
                <p class="flex items-end mb-1"><strong>2. Heure de naissance :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->heure_naissance ?? '...' }}</span></p>
                <p class="flex items-end mb-1"><strong>3. Prénom(s) :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->prenom }}</span></p>
                <p class="flex items-end mb-1"><strong>4. Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->nom }}</span></p>
                <p class="flex items-end mb-1"><strong>5. Sexe :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->sexe_enfant }}</span></p>
                <p class="flex items-end mb-1"><strong>6. Localité ou pays de naissance :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->lieu_naissance_enfant }}</span></p>
            </div>
        </div>
        
        {{-- CADRE PÈRE --}}
        <div class="border border-black mx-2 mb-2 flex relative z-10 print-break-avoid">
            <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg); background-color: hsla(0, 93%, 6%, 0.10);">
                <p class="font-bold text-[10px] tracking-wider">PÈRE</p>
            </div>
            <div class="flex-1 p-2 space-y-1">
                <p class="flex items-end mb-1"><strong>7. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->prenom_pere }} {{ $acte->nom_pere }}</span></p>
                <p class="flex items-end mb-1"><strong>8. Âge :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->demande->volet->age_pere ?? '...' }} ans</span></p>
                <p class="flex items-end mb-1"><strong>9. Domicile :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->domicile_pere }}</span></p>
                <p class="flex items-end mb-1"><strong>10. Profession :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->profession_pere }}</span></p>
            </div>
        </div>

        {{-- CADRE MÈRE --}}
        <div class="border border-black mx-2 mb-2 flex relative z-10 print-break-avoid">
            <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg); background-color: hsla(0, 93%, 6%, 0.10);">
                <p class="font-bold text-[10px] tracking-wider">MÈRE</p>
            </div>
            <div class="flex-1 p-2 space-y-1">
                <p class="flex items-end mb-1"><strong>11. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->prenom_mere }} {{ $acte->nom_mere }}</span></p>
                <p class="flex items-end mb-1"><strong>12. Âge :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->demande->volet->age_mere  ?? '...' }} ans</span></p>
                <p class="flex items-end mb-1"><strong>13. Domicile :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->domicile_mere }}</span></p>
                <p class="flex items-end mb-1"><strong>14. Profession :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->profession_mere }}</span></p>
            </div>
        </div>
        
        {{-- CADRE DÉCLARANT --}}
        <div class="border border-black mx-2 mb-2 flex relative z-10 print-break-avoid">
            <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg); background-color: hsla(0, 93%, 6%, 0.10);">
                <p class="font-bold text-[10px] tracking-wider">DÉCLARANT</p>
            </div>
            <div class="flex-1 p-2 space-y-1">
                <p class="flex items-end mb-1"><strong>15. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">
                    {{ $acte->declarant->prenom_declarant ?? '...' }} {{ $acte->declarant->nom_declarant ?? '...' }}
                </span></p>
                <p class="flex items-end mb-1"><strong>16. Âge :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">
                    {{ $acte->declarant->age_declarant ?? '...' }} ans
                </span></p>
                <p class="flex items-end mb-1"><strong>17. Domicile :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">
                    {{ $acte->declarant->domicile_declarant ?? '...' }}
                </span></p>
                <p class="flex items-end mb-1"><strong>18. Profession :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">
                    {{ $acte->declarant->profession_declarant ?? '...' }}
                </span></p>
                <p class="flex items-end mb-1"><strong>19. N° de la déclaration et date :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">
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
                <p><strong>20. Centre de l'hôpital ou district :</strong> <span class="uppercase font-bold text-blue-700 w-full">
                    {{ $acte->lieu_naissance_enfant ?? '...' }}
                </span></p>
            </div>
        </div>
        
        {{-- Cachet et Signature --}}
        <div class="border border-black mx-2 flex items-center mb-2 relative z-10 print-break-avoid">
            {{-- Cachet de l'officier d'état civil --}}
            <div class="w-[5%] flex items-center justify-center text-center px-1 border-r border-black" style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg); background-color: hsla(0, 93%, 6%, 0.10);">
                <p class="font-bold text-[10px] tracking-wider">OFFICIER</p>
            </div>
            <div class="flex-1 p-2 grid grid-cols-2 gap-4 items-center">
                <div class="space-y-1">
                    <p class="flex items-end mb-1"><strong>21. Prénom(s) et Nom :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->officier->prenom ?? '...' }} {{ $acte->officier->nom ?? '...' }}</span></p>
                    <p class="flex items-end mb-1"><strong>22. Qualité :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ $acte->officier->profession ?? '...' }}</span></p>
                    <p class="flex items-end mb-1"><strong>23. Date :</strong> <span class="uppercase font-bold text-blue-700 border-b border-black flex-grow text-left px-1">{{ \Carbon\Carbon::parse($acte->date_enregistrement_acte)->format('d/m/Y') }}</span></p>
                </div>
                <div class="text-center relative pt-8">
                    <p class="font-bold">24. Signature et cachet de l'officier d'état civil</p>
                    <div class="flex justify-center items-end mt-2 h-32">
                        @if($acte->statut === 'Finalisé')
                            <div class="absolute inset-0">
                                <div class="w-full h-full flex items-end justify-between">
                                    <img src="{{ asset('images/cacher.png') }}" alt="Cachet" style="width:120px; height: auto; object-fit: contain;">
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
            <p class="text-xs italic text-gray-500 mt-4">Document généré via la plateforme iDocsMali.</p>
        </div>
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
        <a href="{{ route('mairie.dashboard.actes') }}"
           class="inline-flex items-center bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 shadow">
            ← Retour
        </a>
    </div>
    {{-- Boutons d'action suppression --}}
      <button onclick="confirmDelete({{ $acte->id }})" class="text-white py-2 px-4 rounded-lg bg-red-600 hover:bg-red-700" title="Supprimer">
        Supprimer l'acte
    </button>
    
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
            csrfInput.setAttribute('name', '_token');
            csrfInput.setAttribute('value', '{{ csrf_token() }}');
            form.appendChild(csrfInput);

            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'DELETE');
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script> 

@endsection