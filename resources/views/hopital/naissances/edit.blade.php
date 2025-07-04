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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{ route('naissances.update', $volet->id_volet) }}">
    @csrf
    @method('PUT')

    <div class="declaration">
        <div class="header">
            REPUBLIQUE DU MALI<br>
            Un Peuple - Un But - Une Foi
        </div>

        {{-- ENFANT --}}
        <div class="section-title">Enfant</div>
        <div class="line">
            <div class="field">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', $volet->date_naissance) }}"
                    required>
            </div>
            <div class="field">
                <label>Heure</label>
                <input type="time" name="heure_naissance" value="{{ old('heure_naissance', $volet->heure_naissance) }}"
                    required>
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Prénoms</label>
                <input type="text" name="prenom_enfant" value="{{ old('prenom_enfant', $volet->prenom_enfant) }}">
            </div>
            <div class="field">
                <label>Nom</label>
                <input type="text" name="nom_enfant" value="{{ old('nom_enfant', $volet->nom_enfant) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Sexe</label>
                <select name="sexe">
                    <option value="M" {{ old('sexe', $volet->sexe) == 'M' ? 'selected' : '' }}>Masculin
                    </option>
                    <option value="F" {{ old('sexe', $volet->sexe) == 'F' ? 'selected' : '' }}>Féminin
                    </option>
                </select>
            </div>
            <div class="field">
                <label>Nombre d’enfants</label>
                <input type="number" name="nbreEnfantAccouchement"
                    value="{{ old('nbreEnfantAccouchement', $volet->nbreEnfantAccouchement) }}">
            </div>
        </div>

        {{-- PÈRE --}}
        <div class="section-title">Père</div>
        <div class="line">
            <div class="field">
                <label>Prénom</label>
                <input type="text" name="prenom_pere" value="{{ old('prenom_pere', $volet->prenom_pere) }}">
            </div>
            <div class="field">
                <label>Nom</label>
                <input type="text" name="nom_pere" value="{{ old('nom_pere', $volet->nom_pere) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Âge</label>
                <input type="number" name="age_pere" value="{{ old('age_pere', $volet->age_pere) }}">
            </div>
            <div class="field">
                <label>Domicile</label>
                <input type="text" name="domicile_pere" value="{{ old('domicile_pere', $volet->domicile_pere) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Ethnie</label>
                <input type="text" name="ethnie_pere" value="{{ old('ethnie_pere', $volet->ethnie_pere) }}">
            </div>
            <div class="field">
                <label>Situation matrimoniale</label>
                <input type="text" name="situation_matrimonial_pere"
                    value="{{ old('situation_matrimonial_pere', $volet->situation_matrimonial_pere) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Niveau scolaire</label>
                <input type="text" name="niveau_instruction_pere"
                    value="{{ old('niveau_instruction_pere', $volet->niveau_instruction_pere) }}">
            </div>
            <div class="field">
                <label>Profession</label>
                <input type="text" name="profession_pere" value="{{ old('profession_pere', $volet->profession_pere) }}">
            </div>
        </div>

        {{-- MÈRE --}}
        <div class="section-title">Mère</div>
        <div class="line">
            <div class="field">
                <label>Prénom</label>
                <input type="text" name="prenom_mere" value="{{ old('prenom_mere', $volet->prenom_mere) }}">
            </div>
            <div class="field">
                <label>Nom</label>
                <input type="text" name="nom_mere" value="{{ old('nom_mere', $volet->nom_mere) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Âge</label>
                <input type="number" name="age_mere" value="{{ old('age_mere', $volet->age_mere) }}">
            </div>
            <div class="field">
                <label>Domicile</label>
                <input type="text" name="domicile_mere" value="{{ old('domicile_mere', $volet->domicile_mere) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Ethnie</label>
                <input type="text" name="ethnie_mere" value="{{ old('ethnie_mere', $volet->ethnie_mere) }}">
            </div>
            <div class="field">
                <label>Situation matrimoniale</label>
                <input type="text" name="situation_matrimonial_mere"
                    value="{{ old('situation_matrimonial_mere', $volet->situation_matrimonial_mere) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Niveau scolaire</label>
                <input type="text" name="niveau_instruction_mere"
                    value="{{ old('niveau_instruction_mere', $volet->niveau_instruction_mere) }}">
            </div>
            <div class="field">
                <label>Profession</label>
                <input type="text" name="profession_mere" value="{{ old('profession_mere', $volet->profession_mere) }}">
            </div>
        </div>

        {{-- DÉCLARANT --}}
        <div class="section-title">Déclarant</div>
        <div class="line">
            <div class="field">
                <label>Prénom</label>
                <input type="text" name="prenom_declarant"
                    value="{{ old('prenom_declarant', $volet->declarant->prenom_declarant) }}">
            </div>
            <div class="field">
                <label>Nom</label>
                <input type="text" name="nom_declarant"
                    value="{{ old('nom_declarant', $volet->declarant->nom_declarant) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Âge</label>
                <input type="number" name="age_declarant"
                    value="{{ old('age_declarant', $volet->declarant->age_declarant) }}">
            </div>
            <div class="field">
                <label>Domicile</label>
                <input type="text" name="domicile_declarant"
                    value="{{ old('domicile_declarant', $volet->declarant->domicile_declarant) }}">
            </div>
        </div>
        <div class="line">
            <div class="field">
                <label>Ethnie</label>
                <input type="text" name="ethnie_declarant"
                    value="{{ old('ethnie_declarant', $volet->declarant->ethnie_declarant) }}">
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success"> Mettre à jour</button>
            <a href="{{ route('hopital.dashboard') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>