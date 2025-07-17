@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white border border-black p-6 text-[16px] font-[Times New Roman] print:p-4 print:w-full print:max-w-full print:border-none">

    <!-- En-tête avec logo et slogan -->
    <div class="flex justify-between items-start mb-4">
        {{-- <img src="{{ asset('images/logo_mali.png') }}" alt="Logo Mali" class="w-24 h-auto"> --}}
        <div class="text-center flex-1">
            <p class="uppercase font-bold">République du Mali</p>
            <p><em>Un Peuple - Un But - Une Foi</em></p>
        </div>
        {{-- <img src="{{ asset('images/tampon_officiel.png') }}" alt="Tampon Officiel" class="w-24 h-auto"> --}}
    </div>

    <!-- Infos de localisation et numéro d’acte -->
    <div class="grid grid-cols-2 gap-2 border border-black p-2">
        <div>
            <p><strong>RÉGION DE :</strong> {{ $acte->Commune->region ?? '...' }}</p>
            <p><strong>CERCLE DE :</strong> {{ $acte->Commune->cercle ?? '...' }}</p>
            <p><strong>COMMUNE DE :</strong> {{ $acte->Commune->nom_commune ?? '...' }}</p>
            <p><strong>CENTRE :</strong> Principal</p>
            <p><strong>DE :</strong> La Commune IV</p>
        </div>
        <div class="text-right">
            <p><strong>Acte de naissance</strong> N° {{ $acte->num_acte }}</p>
            <p class="text-sm">(Volet N°3 – Original remis au déclarant)</p>
            <p><strong>NINA :</strong> ......................................</p>
        </div>
    </div>

    <!-- Infos enfant -->
    <div class="border border-black mt-3 p-2">
        <p><strong>1. Date de naissance :</strong> {{ \Carbon\Carbon::parse($acte->date_naissance_enfant)->translatedFormat('d F Y') }}</p>
        <p><strong>2. Heure de naissance :</strong> {{ $acte->heure_naissance ?? '...' }}</p>
        <p><strong>3. Prénom(s) :</strong> {{ $acte->prenom }}</p>
        <p><strong>4. Nom :</strong> {{ $acte->nom }}</p>
        <p><strong>5. Sexe :</strong> {{ $acte->sexe_enfant }}</p>
        <p><strong>6. Lieu de naissance :</strong> {{ $acte->lieu_naissance_enfant }}</p>
    </div>

    <!-- Infos père -->
    <div class="border border-black mt-3 p-2">
        <p><strong>7. Nom du père :</strong> {{ $acte->nom_pere }}</p>
        {{-- {{ dd($acte->demande->volet) }} --}}
        <p><strong>8. Âge :</strong> {{ $acte->demande->volet->age_pere ?? '...' }} ans</p>
        <p><strong>9. Domicile :</strong> {{ $acte->domicile_pere }}</p>
        <p><strong>10. Profession :</strong> {{ $acte->profession_pere }}</p>
    </div>

    <!-- Infos mère -->
    <div class="border border-black mt-3 p-2">
        <p><strong>11. Nom de la mère :</strong> {{ $acte->nom_mere }}</p>
        <p><strong>12. Âge :</strong> {{ $acte->demande->volet->age_mere ?? '...' }} ans</p>
        <p><strong>13. Domicile :</strong> {{ $acte->domicile_mere }}</p>
        <p><strong>14. Profession :</strong> {{ $acte->profession_mere }}</p>
    </div>

    <!-- Infos déclarant -->
    <div class="border border-black mt-3 p-2">
        <p><strong>15. Déclarant :</strong> {{ $acte->declarant->nom_declarant ?? '...' }}</p>
        <p><strong>16. Âge :</strong> {{ $acte->declarant->age_declarant ?? '...' }} ans</p>
        <p><strong>17. Domicile :</strong> {{ $acte->declarant->domicile_declarant ?? '...' }}</p>
        <p><strong>18. Profession :</strong> {{ $acte->declarant->profession_declarant ?? '...' }}</p>
    </div>

    <!-- Infos enregistrement -->
    <div class="border border-black mt-3 p-2">
        <p><strong>19. N° de déclaration et date :</strong> {{ $acte->declarant->numero_declaration ?? '...' }} du {{ \Carbon\Carbon::parse($acte->declarant->date_declaration)->format('d/m/Y') }}</p>
        <p><strong>20. Centre :</strong> {{ $acte->lieu_naissance_enfant }}</p>
    </div>

    <!-- Officier état civil -->
    <div class="border border-black mt-3 p-2">
        <p><strong>21. Officier d'état civil :</strong> {{ $acte->officier->nom ?? '...' }}</p>
        {{-- {{ $acte->officier->Mairie->nom_mairie ?? '...' }} --}}
        <p><strong>22. Qualité :</strong> {{ $acte->officier->profession ?? '...' }} </p>
        <p><strong>23. Date :</strong> {{ \Carbon\Carbon::parse($acte->date_enregistrement_acte)->format('d/m/Y') }}</p>
    </div>

    <!-- Signature + Tampon officiel -->
    <div class="mt-10 relative h-32">
        <p class="text-right font-semibold">24. Signature et cachet de l’officier d’état civil</p>
        <img src="{{ asset('images/mali2.png') }}" 
             alt="Tampon officiel" 
             class="absolute right-0 bottom-0 w-28 h-28 opacity-80 print:opacity-100">
    </div>

 <div class="flex items-center gap-4 mt-6 print:hidden">
    <!-- Bouton de retour -->
    <a href="{{ route('agent.dashboard') }}"
       class="inline-flex items-center bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 shadow">
        ← Retour
    </a>

    <!-- Formulaire de suppression -->
    {{-- <form action="{{ route('acte.destroy', $acte->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-700 shadow transition duration-200">
            Supprimer cet acte
        </button>

    </form> --}}
    <button onclick="confirmDelete({{ $acte->id_volet }})"
                                class="text-white-100 py-2 px-4 rounded-lg bg-red-600 hover:bg-red-700 mx-1" title="Supprimer">
                                Supprimer
                            </button>
</div>



        {{-- <form action="{{ route('acte.download', $acte->id) }}" method="GET">
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                Télécharger en PDF
            </button>
        </form> --}}
    </div>
</div>
@endsection
