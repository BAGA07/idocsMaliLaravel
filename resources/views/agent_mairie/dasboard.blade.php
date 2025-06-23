@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tableau de bord - Agent de la Mairie</h2>

    {{--  Statistiques --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="alert alert-info text-center">
                <h4>Total</h4>
                <p style="font-size: 22px;">{{ $total }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="alert alert-success text-center">
                <h4>Aujourd'hui</h4>
                <p style="font-size: 22px;">{{ $todayCount }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="alert alert-warning text-center">
                <h4>Cette semaine</h4>
                <p style="font-size: 22px;">{{ $weekCount }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="alert alert-primary text-center">
                <h4>Ce mois</h4>
                <p style="font-size: 22px;">{{ $monthCount }}</p>
            </div>
        </div>
    </div>

    {{-- Tableau des déclarations --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom Enfant</th>
                <th>Sexe Enfant</th>
                <th>Date de naissance</th>
                <th>Nom du père</th>
                <th>Nom de la mère</th>
                <th>Déclarant</th>
                <th>Hôpital</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($declarations as $d)
            <tr>
                <td>{{ $d->prenom_enfant }} {{ $d->nom_enfant }}</td>
                <td>{{ $d->sexe }}</td>
                <td>{{ $d->date_naissance }}</td>
                <td>{{ $d->prenom_pere }} {{ $d->nom_pere }}</td>
                <td>{{ $d->prenom_mere }} {{ $d->nom_mere }}</td>
                <td>{{ $d->declarant->prenom_declarant ?? '-' }} {{ $d->declarant->nom_declarant ?? '-' }}</td>
                <td>{{ $d->hopital->nom_hopital ?? '-' }}</td>
                <td>En cours</td>
                <td>
                    <a href="{{ route('naissances.create', $d->id_volet) }}" class="btn btn-sm btn-warning">Traiter</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
