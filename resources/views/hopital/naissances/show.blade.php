@extends('layouts.app')
@section('content')
<div class="declaration-wrapper right_col" role="main">

    <div class="ticket-box only-print-ticket">
        <h5 class="text-center">Ticket de Déclaration</h5>
        <div><strong>Nom :</strong> {{ $declaration->declarant->nom_declarant }}</div>
        <div><strong>Prénom :</strong> {{ $declaration->declarant->prenom_declarant }}</div>
        <div><strong>Adresse :</strong> {{ $declaration->declarant->domicile_declarant }}</div>
        <div><strong>Téléphone :</strong> {{ $declaration->declarant->telephone ?? '---' }}</div>
        <div><strong>Email :</strong> {{ $declaration->declarant->email ?? '---' }}</div>
        <div><strong>N° Volet :</strong> <span class="red-number">{{ $declaration->num_volet
                }}</span></div>
        <div><strong>Hôpital :</strong> {{ $declaration->hopital->nom_hopital }}</div>
        <div>Signature / Cachet : ______________</div>

        <div class="btn-print no-print">
            <button onclick="window.print()">🖨️ Imprimer</button>
        </div>
    </div>

    {{-- ✅ Volet principal --}}
    <div class="volet-box">

        <div class="text-center">
            <h6 class="fw-bold mb-1">REPUBLIQUE DU MALI</h6>
            <small>Un Peuple - Un But - Une Foi</small>
        </div>

        <div class="row mt-3 mb-2">
            <div class="col-md-6">RÉGION : {{ $declaration->hopital->commune->region ?? '---' }}</div>
            <div class="col-md-6">CERCLE : {{ $declaration->hopital->commune->cercle ?? '---' }}</div>
        </div>
        <div>COMMUNE : {{ $declaration->hopital->commune->nom_commune }}</div>
        <div>CENTRE : Mairie Principale</div>
        <div class="mb-3">CENTRE DE DÉCLARATION : {{ $declaration->hopital->nom_hopital ?? '---' }}</div>

        <div class="section-title">Volet N°2 – Ministère de l’Administration Territoriale</div>

        <div class="text-center mb-3">Déclaration N° : <span class="red-number">{{
                $declaration->num_volet }}</span></div>

        <div class="section-title">Enfant</div>
        <div class="row">
            <div class="col-md-6">1. Date de naissance : {{
                \Carbon\Carbon::parse($declaration->date_naissance)->translatedFormat('d F Y') }}</div>
            <div class="col-md-6">2. Heure : {{ $declaration->heure_naissance }}</div>
        </div>
        <div>3. Date de déclaration : {{ \Carbon\Carbon::parse($declaration->date_declaration)->translatedFormat('d
            F Y') }}</div>
        <div class="row">
            <div class="col-md-6">4. Prénoms : {{ $declaration->prenom_enfant }}</div>
            <div class="col-md-6">5. Nom : {{ $declaration->nom_enfant }}</div>
        </div>
        <div class="row">
            <div class="col-md-6">6. Sexe : {{ $declaration->sexe === 'M' ? 'Masculin' : 'Féminin' }}</div>
            <div class="col-md-6">7. Nombre d’enfants : {{ $declaration->nbreEnfantAccouchement }}</div>
        </div>
        <div class="row">
            <div class="col-md-6">8. Lieu de naissance : {{ $declaration->hopital->commune->region ?? '---' }}</div>
            <div class="col-md-6">9. Lieu d’accouchement : {{ $declaration->hopital->nom_hopital ?? '---' }}</div>
        </div>

        <div class="section-title">Père</div>
        <div class="row">
            <div class="col-md-6">10. Nom : {{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</div>
            <div class="col-md-6">11. Âge : {{ $declaration->age_pere }}</div>
        </div>
        <div class="row">
            <div class="col-md-6">12. Domicile : {{ $declaration->domicile_pere }}</div>
            <div class="col-md-6">13. Ethnie : {{ $declaration->ethnie_pere }}</div>
        </div>
        <div class="row">
            <div class="col-md-6">14. Situation matrimoniale : {{ $declaration->situation_matrimonial_pere }}</div>
            <div class="col-md-6">15. Instruction : {{ $declaration->niveau_instruction_pere }}</div>
        </div>
        <div>16. Profession : {{ $declaration->profession_pere }}</div>

        <div class="section-title">Mère</div>
        <div class="row">
            <div class="col-md-6">17. Nom : {{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</div>
            <div class="col-md-6">18. Âge : {{ $declaration->age_mere }}</div>
        </div>
        <div class="row">
            <div class="col-md-6">19. Domicile : {{ $declaration->domicile_mere }}</div>
            <div class="col-md-6">20. Ethnie : {{ $declaration->ethnie_mere }}</div>
        </div>
        <div class="row">
            <div class="col-md-6">21. Situation matrimoniale : {{ $declaration->situation_matrimonial_mere }}</div>
            <div class="col-md-6">22. Enfants vivants : {{ $declaration->nbreEINouvNee }}</div>
        </div>
        <div>23. Instruction : {{ $declaration->niveau_instruction_mere }}</div>
        <div>24. Profession : {{ $declaration->profession_mere }}</div>

        <div class="section-title">Déclarant</div>
        <div class="row">
            <div class="col-md-6">25. Nom : {{ $declaration->declarant->prenom_declarant }} {{
                $declaration->declarant->nom_declarant }}</div>
            <div class="col-md-6">26. Âge : {{ $declaration->declarant->age_declarant }}</div>
        </div>
        <div>27. Domicile : {{ $declaration->declarant->domicile_declarant }}</div>

        <div class="section-title">Agent</div>
        <div>28. Agent déclarant : {{ Auth::user()->prenom ?? '---' }} {{ Auth::user()->nom }}</div>

        <div class="row text-center mt-4">
            <div class="col-md-6">Signature du déclarant : ____________</div>
            <div class="col-md-6">Signature de l’agent : ____________</div>
        </div>
    </div>
</div>

@endsection