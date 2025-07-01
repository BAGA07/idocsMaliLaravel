@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="container mt-5">

        <div class="card shadow rounded">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fa fa-user"></i> Détails du Manager</h4>
                <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-light btn-sm">
                    <i class="fa fa-edit"></i> Modifier
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Nom :</strong> {{ $manager->nom }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Prénom :</strong> {{ $manager->prenom }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Email :</strong> {{ $manager->email }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Téléphone :</strong> {{ $manager->telephone }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Adresse :</strong> {{ $manager->adresse }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Structure :</strong>
                        @if($manager->hopital)
                        Hôpital – {{ $manager->hopital->nom_hopital }}
                        @elseif($manager->mairie)
                        Mairie – {{ $manager->mairie->nom_mairie }}
                        @else
                        Non assigné
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Date de création :</strong> {{ $manager->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Dernière mise à jour :</strong> {{ $manager->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('managers.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection