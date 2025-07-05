<style>
    .declaration-wrapper {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 20px auto;
        font-family: 'Times New Roman', Times, serif;
    }

    .ticket-box {
        width: 30%;
        border: 1px solid #000;
        background: white;
        padding: 15px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .ticket-box {
        width: 30%;
        border: 1px solid #000;
        background: white;
        padding: 15px;
        font-size: 14px;
        box-sizing: border-box;
        height: 350px;
        /* Hauteur réduite ici */
        overflow: hidden;
        /* Cache tout dépassement */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }


    .ticket-line {
        margin-bottom: 10px;
    }

    .volet-box {
        width: 68%;
        border: 1px solid #000;
        background: white;
        padding: 20px;
        font-size: 14px;
        box-sizing: border-box;
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
        display: flex;
        justify-content: space-between;
        padding: 0 20px;
    }

    .line-red-number {
        text-align: center;
        font-weight: bold;
        margin: 10px 0;
        font-size: 16px;
    }

    .line-red-number span.red {
        color: red;
        margin-left: 5px;
    }

    .btn-print {
        text-align: center;
        margin-top: 20px;
    }

    .btn-print button {
        background-color: #3490dc;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    @media print {

        .volet-box,
        .btn-print,
        .text-center,
        .no-print {
            display: none !important;
        }

        .only-print-ticket {
            width: 100% !important;
            border: none;
            box-shadow: none;
        }

        @page {
            size: A5 portrait;
            /* ou: size: 148mm 210mm; */
            margin: 10mm;
        }
    }
</style>

<div class="declaration-wrapper">

    <div class="ticket-box ticket-box only-print-ticket">
        <h4 class="header">Ticket de Déclaration</h4>

        <div class="ticket-line">Nom du déclarant : <strong>{{ $declaration->declarant->nom_declarant }}</strong>
        </div>
        <div class="ticket-line">Prénom du déclarant : <strong>{{ $declaration->declarant->prenom_declarant
                }}</strong>
        </div>
        <div class="ticket-line">Adresse : <strong>{{ $declaration->declarant->domicile_declarant }}</strong></div>
        <div class="ticket-line">Téléphone : <strong>{{ $declaration->declarant->telephone ?? '---'
                }}</strong></div>
        <div class="ticket-line">Mail : <strong>{{ $declaration->declarant->email ?? '---' }}</strong></div>
        <div class="ticket-line">Numéro Volet : <span style="color: red;"><strong>{{
                    $declaration->declarant->numero_declaration }}</strong></span></div>
        <div class="ticket-line">Hopital : <strong>{{ $declaration->hopital->nom_hopital }}</strong> <br><br>
            Signature/Cachet : <br>
        </div>

        <div class="btn-print no-print">
            <button onclick="window.print()">Imprimer</button>
        </div>
    </div>

    {{-- ✅ Volet N°2 (droite) --}}
    <div class="volet-box">
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

        <div class="section-title">VOLET N°2
            <h5>(Destiné au Ministère de l'Administration Territoriale)</h5>
        </div>

        <div class="line-red-number">
            DÉCLARATION DE NAISSANCE N° :
            <span class="red">{{ $declaration->declarant->numero_declaration ?? '---' }}</span>
        </div>

        <div class="section-title">ENFANT</div>
        <div class="line">
            <div class="field">1. Date de naissance : {{
                \Carbon\Carbon::parse($declaration->date_naissance)->translatedFormat('d F Y') }}</div>
            <div class="field">2. Heure : {{ $declaration->heure_naissance }}</div>
        </div>
        <div class="line">
            <div class="field">3. Date de déclaration : {{
                \Carbon\Carbon::parse($declaration->date_declaration)->translatedFormat('d F Y') }}</div>
        </div>
        <div class="line">
            <div class="field">4. Prénoms : {{ $declaration->prenom_enfant }}</div>
            <div class="field">5. Nom : {{ $declaration->nom_enfant }}</div>
        </div>
        <div class="line">
            <div class="field">6. Sexe : {{ $declaration->sexe === 'M' ? 'Masculin' : ($declaration->sexe === 'F' ?
                'Féminin' : '---') }}</div>
            <div class="field">7. Nombre d’enfants issus de cet accouchement : {{ $declaration->nbreEnfantAccouchement
                }}</div>
        </div>
        <div class="line">
            <div class="field">8. Lieu de naissance : {{ $declaration->hopital->commune->region ?? '---' }}</div>
            <div class="field">9. Lieu d’accouchement : {{ $declaration->hopital->nom_hopital ?? '---' }}</div>
        </div>

        <div class="section-title">PÈRE</div>
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

        <div class="section-title">MÈRE</div>
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

        <div class="section-title">DÉCLARANT</div>
        <div class="line">
            <div class="field">25. Prénom et nom : {{ $declaration->declarant->prenom_declarant }} {{
                $declaration->declarant->nom_declarant }}</div>
            <div class="field">26. Âge : {{ $declaration->declarant->age_declarant }}</div>
        </div>
        <div class="line">
            <div class="field">27. Domicile : {{ $declaration->declarant->domicile_declarant }}</div>
        </div>

        <div class="section-title">AGENT DE DÉCLARATION</div>
        <div class="line">
            <div class="field">28. Agent : {{ Auth::user()->prenom ?? '---' }} {{ Auth::user()->nom }}</div>
        </div>

        <div class="signature">
            <div class="field text-center">
                Signature du déclarant :<br><br> ____________________
            </div>
            <div class="field text-center">
                Signature de l'agent :<br><br> ____________________
            </div>
        </div><br><br>
    </div>
</div>