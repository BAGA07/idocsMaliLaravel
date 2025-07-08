<style>
    .declaration {
        width: 800px;
        margin: auto;
        font-family: 'Times New Roman', Times, serif;
        font-size: 14px;
        padding: 20px;
        background: white;
        border: 1px solid #000;
        position: relative;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .section-title {
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .line {
        display: flex;
        justify-content: space-between;
        margin: 5px 0;
        white-space: pre-wrap;
    }

    .field {
        flex: 1;
        padding: 0 5px;
    }

    .signature {
        margin-top: 30px;
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>
<div class="right_col" role="main">
    <div class="declaration">
        <div class="header">
            <div>REPUBLIQUE DU MALI</div>
            <div>Un Peuple - Un But - Une Foi</div>
        </div>

        <div class="line">
            <div class="field">RÉGION DE : {{ $declaration->hopital->commune->region ?? '---' }}</div>
            <div class="field">CERCLE DE : {{ $declaration->hopital->commune->cercle ?? '---' }}</div>
        </div>
        <div class="line">
            <div class="field">COMMUNE DE : {{ $declaration->hopital->commune->nom_commune }}</div>
        </div>
        <div class="line">
            <div class="field">CENTRE DE : Mairie Principale</div>
        </div>
        <div class="line">
            <div class="field">CENTRE DE DÉCLARATION DE : {{ $declaration->hopital->nom_hopital ?? '---' }}</div>
        </div>

        <div class="section-title">VOLET N°2</div>
        <div class="line">
            <div class="field">DÉCLARATION DE NAISSANCE N° : {{ $declaration->declarant->numero_declaration ?? '---' }}
            </div>
        </div>

        <div class="section-title">ENFANT</div>
        <div class="line">
            <div class="field">1. Date de naissance : {{
                \Carbon\Carbon::parse($declaration->date_naissance)->translatedFormat('d F Y') }}</div>
            <div class="field">2. Heure : {{ $declaration->heure_naissance }}</div>
        </div>
        <div class="line">
            <div class="field">3. Date de déclaration : {{
                \Carbon\Carbon::parse($declaration->date_declaration)->format('d/m/Y') }}</div>
        </div>
        <div class="line">
            <div class="field">4. Prénoms : {{ $declaration->prenom_enfant }}</div>
            <div class="field">5. Nom : {{ $declaration->nom_enfant }}</div>
        </div>
        <div class="line">
            <div class="field">6. Sexe : {{ $declaration->sexe ?? '---' }}</div>
            <div class="field">7. Nombre d’enfants issus de cet accouchement : {{ $declaration->nbreEnfantAccouchement
                }}
            </div>
        </div>
        <div class="line">
            <div class="field">8. Lieu de naissance : {{ $declaration->hopital->ville ?? '---' }}</div>
            <div class="field">9. Lieu d’accouchement : {{ $declaration->hopital->nom ?? '---' }}</div>
        </div>

        <div class="section-title">PERE</div>
        <div class="line">
            <div class="field">10. Prénom et nom : {{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</div>
            <div class="field">11. Âge : {{ $declaration->age_pere }}</div>
        </div>
        <div class="line">
            <div class="field">12. Domicile : {{ $declaration->domicile_pere }}</div>
            <div class="field">13. Ethnie ou nationalité : {{ $declaration->ethnie_pere }}</div>
        </div>
        <div class="line">
            <div class="field">14. Situation matrimoniale : {{ $declaration->situation_matrimonial_pere }}</div>
            <div class="field">15. Niveau d'instruction : {{ $declaration->niveau_instruction_pere }}</div>
        </div>
        <div class="line">
            <div class="field">16. Profession : {{ $declaration->profession_pere }}</div>
        </div>

        <div class="section-title">MERE</div>
        <div class="line">
            <div class="field">17. Prénom et nom : {{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</div>
            <div class="field">18. Âge : {{ $declaration->age_mere }}</div>
        </div>
        <div class="line">
            <div class="field">19. Domicile : {{ $declaration->domicile_mere }}</div>
            <div class="field">20. Ethnie ou nationalité : {{ $declaration->ethnie_mere }}</div>
        </div>
        <div class="line">
            <div class="field">21. Situation matrimoniale : {{ $declaration->situation_matrimonial_mere }}</div>
            <div class="field">22. Nbre d’enfants nés vivants y compris celui-ci : {{ $declaration->nbreEINouvNee }}
            </div>
        </div>
        <div class="line">
            <div class="field">23. Niveau d'instruction : {{ $declaration->niveau_instruction_mere }}</div>
            <div class="field">24. Profession : {{ $declaration->profession_mere }}</div>
        </div>

        <div class="section-title">DECLARANT</div>
        <div class="line">
            <div class="field">25. Prénom et nom : {{ $declaration->declarant->prenom_declarant }} {{
                $declaration->declarant->nom_declarant }}</div>
            <div class="field">26. Âge : {{ $declaration->declarant->age_declarant }}</div>
        </div>
        <div class="line">
            <div class="field">27. Domicile : {{ $declaration->declarant->domicile_declarant }}</div>
        </div>
        <div class="line">
            <div class="field">28. Agent de déclaration : {{ $declaration->declarant->nom_declarant ?? '---' }} {{
                $declaration->declarant->prenom_declarant }}</div>
        </div>

        <div class="signature">
            Signature du déclarant : ____________________
        </div>
    </div>

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-primary">Imprimer</button>
    </div>
</div>