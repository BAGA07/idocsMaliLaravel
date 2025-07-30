@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="text-center mb-4">
        <a href="{{ route('hopital.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <form method="POST" action="{{ route('naissances.store') }}" class="card p-4 shadow-sm">
        @csrf

        <h5 class="text-center text-uppercase fw-bold mb-4">République du Mali<br><small class="text-muted">Un Peuple -
                Un But - Une Foi</small></h5>

        {{-- ENFANT --}}
        <h6 class="fw-bold border-bottom pb-2 mb-3 text-uppercase">Informations sur l’enfant</h6>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Date de naissance</label>
                <input type="date" name="date_naissance" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Heure</label>
                <input type="time" name="heure_naissance" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Prénoms</label>
                <input type="text" name="prenom_enfant" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="nom_enfant" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Sexe</label>
                <select name="sexe" class="form-select">
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nombre d’enfants issus de cet accouchement</label>
                <input type="number" name="nbreEnfantAccouchement" min="1" class="form-control">
            </div>
        </div>

        {{-- PÈRE --}}
        <h6 class="fw-bold border-bottom pb-2 mb-3 text-uppercase">Père</h6>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom_pere" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="nom_pere" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Âge</label>
                <input type="number" name="age_pere" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Domicile</label>
                <input type="text" name="domicile_pere" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Ethnie</label>
                <input type="text" name="ethnie_pere" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Situation matrimoniale</label>
                <select name="situation_matrimonial_pere" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <option value="Marié">Marié</option>
                    <option value="Célibataire">Célibataire</option>
                    <option value="Divorcé">Divorcé</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Niveau scolaire</label>
                <input type="text" name="niveau_scolaire_pere" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Profession</label>
                <input type="text" name="profession_pere" class="form-control" required>
            </div>
        </div>

        {{-- MÈRE --}}
        <h6 class="fw-bold border-bottom pb-2 mb-3 text-uppercase">Mère</h6>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom_mere" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="nom_mere" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Âge</label>
                <input type="number" name="age_mere" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Domicile</label>
                <input type="text" name="domicile_mere" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Ethnie</label>
                <input type="text" name="ethnie_mere" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Situation matrimoniale</label>
                <select name="situation_matrimonial_mere" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <option value="Marié">Marié</option>
                    <option value="Célibataire">Célibataire</option>
                    <option value="Divorcé">Divorcé</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Niveau scolaire</label>
                <input type="text" name="niveau_instruction_mere" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Profession</label>
                <input type="text" name="profession_mere" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre d'enfants nés vivants (y compris celui-ci)</label>
            <input type="number" name="nbreEINouvNee" class="form-control" required>
        </div>

        {{-- DÉCLARANT --}}
        <h6 class="fw-bold border-bottom pb-2 mb-3 text-uppercase">Déclarant</h6>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom_declarant" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="nom_declarant" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Âge</label>
                <input type="number" name="age_declarant" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Domicile</label>
                <input type="text" name="domicile_declarant" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label">Ethnie</label>
            <input type="text" name="ethnie_declarant" class="form-control" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-dark">✅ Enregistrer</button>
            <a href="{{ route('hopital.dashboard') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('hopital.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection