<style>
    .declaration {
        width: 800px;
        margin: auto;
        font-family: 'Times New Roman', Times, serif;
        font-size: 14px;
        padding: 20px;
        background: white;
        border: 1px solid #000;
    }

    .header,
    .section-title {
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .line {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .field {
        flex: 1;
        margin-right: 10px;
    }

    input,
    select {
        width: 100%;
        padding: 5px;
        font-size: 14px;
        font-family: inherit;
    }
</style>

<form method="POST" action="{{ route('naissances.store') }}">
    @csrf

    <div class="declaration">
        <div class="header">
            REPUBLIQUE DU MALI<br>
            Un Peuple - Un But - Une Foi
        </div>

        <div class="section-title">Enfant</div>
        <div class="line">
            <div class="field">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" required>
            </div>
            <div class="field">
                <label>Heure</label>
                <input type="time" name="heure_naissance" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Prénoms</label>
                <input type="text" name="prenom_enfant">
            </div>
            <div class="field">
                <label>Nom</label>
                <input type="text" name="nom_enfant">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Sexe</label>
                <select name="sexe">
                    <option value="Masculin">Masculin</option>
                    <option value="Féminin">Féminin</option>
                </select>
            </div>
            <div class="field">
                <label>Nombre d’enfants</label>
                <input type="number" name="nbreEnfantAccouchement" min="1">
            </div>
        </div>

        <div class="section-title">Père</div>
        <div class="line">
            <div class="field">
                <label>Prénom</label>
                <input type="text" name="prenom_pere" required>
            </div>
            <div class="field">
                <label>Nom</label>
                <input type="text" name="nom_pere" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Âge</label>
                <input type="number" name="age_pere" required>
            </div>
            <div class="field">
                <label>Domicile</label>
                <input type="text" name="domicile_pere" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Ethnie</label>
                <input type="text" name="ethnie_pere" required>
            </div>
            <div class="field">
                <label>Situation matrimoniale</label>
                <input type="text" name="situation_matrimoniale_pere" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Niveau scolaire</label>
                <input type="text" name="niveau_scolaire_pere" required>
            </div>
            <div class="field">
                <label>Profession</label>
                <input type="text" name="profession_pere" required>
            </div>
        </div>

        <div class="section-title">Mère</div>
        <div class="line">
            <div class="field">
                <label>Prénom</label>
                <input type="text" name="prenom_mere" required>
            </div>
            <div class="field">
                <label>Nom</label>
                <input type="text" name="nom_mere" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Âge</label>
                <input type="number" name="age_mere" required>
            </div>
            <div class="field">
                <label>Domicile</label>
                <input type="text" name="domicile_mere" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Ethnie</label>
                <input type="text" name="ethnie_mere" required>
            </div>
            <div class="field">
                <label>Situation matrimoniale</label>
                <input type="text" name="situation_matrimoniale_mere" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Niveau scolaire</label>
                <input type="text" name="niveau_instruction_mere" required>
            </div>
            <div class="field">
                <label>Profession</label>
                <input type="text" name="profession_mere" required>
            </div>
        </div>

        <div class="section-title">Déclarant</div>
        <div class="line">
            <div class="field">
                <label>Prénom</label>
                <input type="text" name="prenom_declarant" required>
            </div>
            <div class="field">
                <label>Nom</label>
                <input type="text" name="nom_declarant" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Âge</label>
                <input type="number" name="age_declarant" required>
            </div>
            <div class="field">
                <label>Domicile</label>
                <input type="text" name="domicile_declarant" required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Ethnie</label>
                <input type="text" name="ethnie_declarant" required>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">✅ Enregistrer</button>
            <a href="{{ route('hopital.dashboard') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>