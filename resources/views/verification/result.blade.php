@extends('layouts.app')
@section('titre', "Vérification d'authenticité")
@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 style="color:#0d6efd; font-weight:bold;">Vérification d'authenticité</h2>
    </div>
    @if($type === 'volet')
        <div class="alert alert-success text-center" style="max-width:500px; margin:auto; border:2px solid #198754; border-radius:12px; background:#f6fff8;">
            <h4 style="color:#198754; font-weight:bold;">Volet authentique</h4>
            <hr>
            <p>Numéro de volet : <strong>{{ $data->num_volet }}</strong></p>
            <p>Nom de l'enfant : <strong>{{ $data->nom_enfant }}</strong></p>
            <p>Date de naissance : <strong>{{ $data->date_naissance }}</strong></p>
            <p>Déclarant : <strong>{{ $data->declarant->prenom_declarant ?? '' }} {{ $data->declarant->nom_declarant ?? '' }}</strong></p>
            <p>Hôpital : <strong>{{ $data->hopital->nom_hopital ?? '' }}</strong></p>
        </div>
    @elseif($type === 'acte')
        <div class="alert alert-success text-center" style="max-width:500px; margin:auto; border:2px solid #198754; border-radius:12px; background:#f6fff8;">
            <h4 style="color:#198754; font-weight:bold;">Acte authentique</h4>
            <hr>
            <p>Numéro d'acte : <strong>{{ $data->num_acte }}</strong></p>
            <p>Nom de l'enfant : <strong>{{ $data->nom }}</strong></p>
            <p>Date de naissance : <strong>{{ $data->date_naissance_enfant }}</strong></p>
            <p>Commune : <strong>{{ $data->Commune->nom_commune ?? '' }}</strong></p>
        </div>
    @else
        <div class="alert alert-danger text-center" style="max-width:500px; margin:auto; border:2px solid #dc3545; border-radius:12px; background:#fff6f6;">
            <h4 style="color:#dc3545; font-weight:bold;">Document invalide ou non trouvé</h4>
            <hr>
            <p>Le QR code scanné ne correspond à aucun document authentique.</p>
        </div>
    @endif
    <div class="text-center mt-4">
        <a href="/" class="btn btn-primary">Retour à l'accueil</a>
    </div>
</div>
@endsection 