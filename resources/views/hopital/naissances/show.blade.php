@extends('layouts.app')
@section('titre')Détails @endsection
@section('content')
<div class="btn-return text-center">
    <a href="{{ route('hopital.dashboard') }}" class="btn btn-outline-secondary rounded-pill">
        <i class="fa fa-arrow-left"></i> Retour à la liste
    </a>
</div>
<div class="flex flex-col lg:flex-row gap-6 p-6">

    <div class="bg-white shadow-md rounded-md p-6 w-full lg:w-1/3 print:w-full print:mb-6">
        <h2 class="text-center font-semibold text-lg border-b pb-2 mb-4">Ticket de Déclaration</h2>

        <ul class="space-y-2 text-sm text-gray-700">
            <li><strong>Nom :</strong> {{ $declaration->declarant->nom_declarant }}</li>
            <li><strong>Prénom :</strong> {{ $declaration->declarant->prenom_declarant }}</li>
            <li><strong>Adresse :</strong> {{ $declaration->declarant->domicile_declarant }}</li>
            <li><strong>Téléphone :</strong> {{ $declaration->declarant->telephone ?? '---' }}</li>
            <li><strong>Email :</strong> {{ $declaration->declarant->email ?? '---' }}</li>
            <li><strong>N° Volet :</strong> <span class="text-red-600 font-semibold">{{ $declaration->num_volet
                    }}</span></li>
            <li><strong>Hôpital :</strong> {{ $declaration->hopital->nom_hopital }}</li>
            <li class="pt-4">Signature / Cachet : _______________________</li>
        </ul>

        <div class="mt-6 text-right print:hidden">
            <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                🖨️ Imprimer
            </button>
        </div>
    </div>

    <!-- VOLET À DROITE -->
    <div class="bg-white shadow-md rounded-md p-6 w-full lg:w-2/3 print:w-full">

        <div class="text-center mb-4">
            <h3 class="font-bold uppercase">République du Mali</h3>
            <p class="text-sm text-gray-600">Un Peuple - Un But - Une Foi</p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm text-gray-800">
            <div>RÉGION : {{ $declaration->hopital->commune->region ?? '---' }}</div>
            <div>CERCLE : {{ $declaration->hopital->commune->cercle ?? '---' }}</div>
            <div class="col-span-2">COMMUNE : {{ $declaration->hopital->commune->nom_commune }}</div>
            <div class="col-span-2">CENTRE DE DÉCLARATION : {{ $declaration->hopital->nom_hopital ?? '---' }}</div>
        </div>

        <hr class="my-4 border-gray-300">

        <h4 class="font-semibold text-blue-600 text-md mb-2">Volet N°2 – Ministère de l’Administration Territoriale</h4>
        <p class="mb-4 text-center text-lg font-bold text-red-600">Déclaration N° : {{ $declaration->num_volet }}</p>

        <!-- ENFANT -->
        <div class="mb-6">
            <h5 class="font-semibold text-gray-700 mb-2"> Informations sur l’Enfant</h5>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div>1. Date de naissance : {{ \Carbon\Carbon::parse($declaration->date_naissance)->translatedFormat('d
                    F Y') }}</div>
                <div>2. Heure : {{ $declaration->heure_naissance }}</div>
                <div class="col-span-2">3. Date de déclaration : {{
                    \Carbon\Carbon::parse($declaration->date_declaration)->translatedFormat('d F Y') }}</div>
                <div>4. Prénoms : {{ $declaration->prenom_enfant }}</div>
                <div>5. Nom : {{ $declaration->nom_enfant }}</div>
                <div>6. Sexe : {{ $declaration->sexe === 'M' ? 'Masculin' : 'Féminin' }}</div>
                <div>7. Nombre d’enfants : {{ $declaration->nbreEnfantAccouchement }}</div>
                <div>8. Lieu de naissance : {{ $declaration->hopital->commune->region ?? '---' }}</div>
                <div>9. Lieu d’accouchement : {{ $declaration->hopital->nom_hopital ?? '---' }}</div>
            </div>
        </div>

        <!-- PÈRE -->
        <div class="mb-6">
            <h5 class="font-semibold text-gray-700 mb-2"> Informations sur le Père</h5>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div>10. Prenom et Nom : {{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</div>
                <div>11. Âge : {{ $declaration->age_pere }}</div>
                <div>12. Domicile : {{ $declaration->domicile_pere }}</div>
                <div>13. Ethnie : {{ $declaration->ethnie_pere }}</div>
                <div>14. Situation matrimoniale : {{ $declaration->situation_matrimonial_pere }}</div>
                <div>15. Instruction : {{ $declaration->niveau_instruction_pere }}</div>
                <div class="col-span-2">16. Profession : {{ $declaration->profession_pere }}</div>
            </div>
        </div>

        <!-- MÈRE -->
        <div class="mb-6">
            <h5 class="font-semibold text-gray-700 mb-2"> Informations sur la Mère</h5>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div>17. Prenom et Nom : {{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</div>
                <div>18. Âge : {{ $declaration->age_mere }}</div>
                <div>19. Domicile : {{ $declaration->domicile_mere }}</div>
                <div>20. Ethnie : {{ $declaration->ethnie_mere }}</div>
                <div>21. Situation matrimoniale : {{ $declaration->situation_matrimonial_mere }}</div>
                <div>22. Enfants vivants : {{ $declaration->nbreEINouvNee }}</div>
                <div>23. Instruction : {{ $declaration->niveau_instruction_mere }}</div>
                <div>24. Profession : {{ $declaration->profession_mere }}</div>
            </div>
        </div>

        <!-- DÉCLARANT -->
        <div class="mb-6">
            <h5 class="font-semibold text-gray-700 mb-2">🧾 Informations sur le Déclarant</h5>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div>25. Nom : {{ $declaration->declarant->prenom_declarant }} {{ $declaration->declarant->nom_declarant
                    }}</div>
                <div>26. Âge : {{ $declaration->declarant->age_declarant }}</div>
                <div class="col-span-2">27. Domicile : {{ $declaration->declarant->domicile_declarant }}</div>
            </div>
        </div>

        <!-- AGENT -->
        <div class="mb-6">
            <h5 class="font-semibold tgrid grid-cols-2 gap-4 mt-6 text-sm text-center"> Agent de Déclaration</h5>
            <div class="text-sm">{{ Auth::user()->prenom ?? '---' }} {{ Auth::user()->nom }}</div>
        </div>

        <!-- SIGNATURES -->
        <div class="grid grid-cols-2 gap-4 mt-6 text-sm text-center">
            <div>Signature du déclarant : ____________________</div>
            <div>Signature de l’agent : ______________________</div>
        </div>
    </div>
</div>
<form action="{{ route('hopital.demandes.envoyer', $declaration->id_volet) }}" method="POST">
    @csrf
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <i class="fa fa-paper-plane"></i> Envoyer demande à la mairie
    </button>
</form>

<div class="btn-return text-center">
    <a href="{{ route('hopital.dashboard') }}" class="btn btn-outline-secondary rounded-pill">
        <i class="fa fa-arrow-left"></i> Retour à la liste
    </a>
</div>
@endsection