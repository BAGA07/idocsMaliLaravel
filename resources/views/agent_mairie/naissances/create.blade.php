@extends('layouts.app')
@section('content')
<!-- <!-- <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container">
    <h2>Créer un acte de naissance</h2>

    <form action="" method="POST">
        @csrf

        {{-- Infos de l’enfant --}}
        <!-- <div class="form-group">
            <label>Numéro d'acte</label>
            <input type="number" name="num_acte" class="form-control" required>
        </div> -->
<!-- 
        <div class="form-group">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance_enfant" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Lieu de naissance</label>
            <input type="text" name="lieu_naissance_enfant" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Sexe</label>
            <select name="sexe_enfant" class="form-control" required>
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
            </select>
        </div>

        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

        {{-- Informations du père --}}
        <hr>
        <div class="form-group">
            <label>Nom du père</label>
            <input type="text" name="nom_pere" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Prénom du père</label>
            <input type="text" name="prenom_pere" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Profession du père</label>
            <input type="text" name="proffesion_pere" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Domicile du père</label>
            <input type="text" name="domicile_pere" class="form-control" required>
        </div>

        {{-- Informations de la mère --}}
        <hr>
        <div class="form-group">
            <label>Nom de la mère</label>
            <input type="text" name="nom_mere" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Prénom de la mère</label>
            <input type="text" name="prenom_mere" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Profession de la mère</label>
            <input type="text" name="proffesion_mere" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Domicile de la mère</label>
            <input type="text" name="domicile_mere" class="form-control" required>
        </div>

        {{-- Listes déroulantes pour les relations --}}
        <hr>
        <div class="form-group">
            <label>Officier d'état civil</label>
            <select name="id_officier" class="form-control" required>
                @foreach($officiers as $officier)
                    <option value="{{ $officier->id }}">{{ $officier->nom }}</option>
                @endforeach
            </select>
        </div>

        

        <div class="form-group">
            <label>Commune</label>
            <select name="id_commune" class="form-control" required>
                @foreach($communes as $commune)
                    <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="id_demande" value="{{ $demande->id }}">
        <input type="hidden" name="id_volet" value="{{ optional($demande->volet)->id_volet }}">

        <div class="form-group">
            <label>Date d’enregistrement de l’acte</label>
            <input type="date" name="date_enregistrement_acte" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer l’acte</button>
    </form>
</div> -->

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container">
    <h3>Création d'un Acte de Naissance</h3>

    <form action="{{ route('acte.store') }}" method="POST">
        @csrf

        <input type="hidden" name="demande_id" value="{{ $demande->id }}">



        <div class="mb-3">
            <label>Prénom de l'enfant</label>
            <input type="text" name="prenom_enfant" class="form-control"
                value="{{ $demande->volet->prenom_enfant ?? '' }}">
        </div>

        <div class="mb-3">
            <label>Nom de l'enfant</label>
            <input type="text" name="nom_enfant" class="form-control" value="{{ $demande->volet->nom_enfant ?? '' }}">
        </div>

        <div class="mb-3">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance" class="form-control"
                value="{{ $demande->volet->date_naissance ?? '' }}">
        </div>

        <div class="mb-3">
            <label>Lieu de naissance (Hôpital)</label>
            <input type="text" name="lieu_naissance" class="form-control"
                value="{{ $demande->volet->hopital->nom_hopital ?? '' }}" readonly>
        </div>
        <!-- Heure de naissance -->
        <div class="mb-3">
            <label>Heure de naissance</label>
            <input type="time" name="heure_naissance" class="form-control"
                value="{{ $demande->volet->heure_naissance ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Sexe Enfant</label>
            <input type="texe" name="sexe_enfant" class="form-control" value="{{ $demande->volet->sexe ?? '' }}">
        </div>

        <!-- Informations sur le père -->
        <h5>Informations du Père</h5>
        <div class="mb-3">
            <label>Prénom du père</label>
            <input type="text" name="prenom_pere" class="form-control" value="{{ $demande->volet->prenom_pere ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Nom du père</label>
            <input type="text" name="nom_pere" class="form-control" value="{{ $demande->volet->nom_pere ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Âge du père</label>
            <input type="number" name="age_pere" class="form-control" value="{{ $demande->volet->age_pere ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Domicile du père</label>
            <input type="text" name="domicile_pere" class="form-control"
                value="{{ $demande->volet->domicile_pere ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Profession du père</label>
            <input type="text" name="profession_pere" class="form-control"
                value="{{ $demande->volet->profession_pere ?? '' }}">
        </div>

        <!-- Informations sur la mère -->
        <h5>Informations de la Mère</h5>
        <div class="mb-3">
            <label>Prénom de la mère</label>
            <input type="text" name="prenom_mere" class="form-control" value="{{ $demande->volet->prenom_mere ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Nom de la mère</label>
            <input type="text" name="nom_mere" class="form-control" value="{{ $demande->volet->nom_mere ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Âge de la mère</label>
            <input type="number" name="age_mere" class="form-control" value="{{ $demande->volet->age_mere ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Domicile de la mère</label>
            <input type="text" name="domicile_mere" class="form-control"
                value="{{ $demande->volet->domicile_mere ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Profession de la mère</label>
            <input type="text" name="profession_mere" class="form-control"
                value="{{ $demande->volet->profession_mere ?? '' }}">
        </div>
        {{-- Listes déroulantes pour les relations --}}
        <hr>
        <div class="form-group">
            <label>Officier d'état civil</label>
            <select name="id_officier" class="form-control" required>
                @foreach($officiers as $officier)
                <option value="{{ $officier->id }}">{{ $officier->nom }}</option>
                @endforeach
            </select>
        </div>



        <div class="form-group">
            <label>Commune</label>
            <select name="id_commune" class="form-control" required>
                @foreach($communes as $commune)
                <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                @endforeach
            </select>
        </div>

        <br>
        <button type="submit" class="btn btn-success">Enregistrer l'acte</button>
    </form>
</div>
@endsection