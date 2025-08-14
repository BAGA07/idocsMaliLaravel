@extends('layouts.app')

@section('content')
<style>
    .declaration {
        max-width: 850px;
        margin: 30px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
        font-size: 14px;
    }

    .header,
    .section-title {
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .line {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 15px;
    }

    .field {
        flex: 1;
        min-width: 240px;
    }

    label {
        font-weight: 600;
        margin-bottom: 4px;
        display: block;
    }

    input,
    select {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #fdfdfd;
    }

    .btn-primary,
    .btn-secondary {
        padding: 8px 20px;
        font-size: 14px;
        border-radius: 20px;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #444;
        border-color: #444;
        color: white;
    }

    .btn-primary:hover {
        background-color: #333;
        border-color: #333;
    }

    .btn-secondary {
        background-color: #aaa;
        border-color: #aaa;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #888;
        border-color: #888;
    }

    .btn-return {
        display: inline-block;
        margin: 20px auto 0;
        text-align: center;
    }

    .alert {
        max-width: 850px;
    }
</style>
<div class="right_col" role="main">
    @if ($errors->any())
    <div class="alert alert-danger w-75 mx-auto mt-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="btn-return text-center">
        <a href="{{ route('hopital.dashboard') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fa fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <form method="POST" action="{{ route('naissances.store') }}">
        @csrf

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
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>
                    </select>
                </div>
                <div class="field">
                    <label>Nombre d’enfants issus de cet accouchement</label>
                    <input type="number" name="nbreEnfantAccouchement" min="1">
                </div>
            </div>

            {{-- PÈRE --}}
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
                    <select name="situation_matrimonial_pere" required>
                        <option value="">-- Choisir --</option>
                        <option value="Marié">Marié</option>
                        <option value="Célibataire">Célibataire</option>
                        <option value="Divorcé">Divorcé</option>
                    </select>
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

            {{-- MÈRE --}}
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
                    <select name="situation_matrimonial_mere" required>
                        <option value="">-- Choisir --</option>
                        <option value="Marié">Marié</option>
                        <option value="Célibataire">Célibataire</option>
                        <option value="Divorcé">Divorcé</option>
                    </select>
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
            <div class="line">
                <div class="field">
                    <label>Nombre d'enfant Née vivant y compris celui-ci</label>
                    <input type="number" name="nbreEINouvNee" required>
                </div>
            </div>

            {{-- DÉCLARANT --}}
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
                    <label>Téléphone</label>
                    <input type="text" name="telephone" required>
                </div>
                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email" required>
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
    <div class="btn-return text-center">
        <a href="{{ route('hopital.dashboard') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fa fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection