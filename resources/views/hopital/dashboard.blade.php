@extends('layouts.app')

@section('content')
<div class="right_col" role="main">

    {{-- Dashboard pour citoyen --}}
    {{-- @if (session('user')['role'] === 'citoyen') --}}
    {{-- <div class="container">
        <section class="welcome-section text-center shadow-lg">
            <h1>Bienvenue <strong>{{ Auth::user()->nom }}</strong></h1>

            <a href="" class="btn btn-welcome">Faire une nouvelle declaration
                de naissance</a>
        </section>
    </div> --}}
    <div class="row mt-4">
        {{-- Statistique - Total des demandes --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-file-text-o"></i></div>
                <div class="count">23</div>
                <h3>Total des Naissance</h3>
                <p>Depuis votre inscription</p>
            </div>
        </div>

        {{-- Statistique - Demandes validées --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-circle"></i></div>
                <div class="count">23</div>
                <h3>Total Garçons</h3>
                <p>Le nombre de garçon née cette année</p>
            </div>
        </div>

        {{-- Statistique - Demandes en attente --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-hourglass-half"></i></div>
                <div class="count">34</div>
                <h3>Total Filles</h3>
                <p>Le nombre de filles née cette année</p>
            </div>
        </div>
    </div>

    {{-- Tableau des demandes --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste des naissance enregistrées </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <span><a href="{{ route('naissance.create') }}" class="btn btn-primary btn-xs"><i
                                        class="fa fa-plus"></i> Nouvelle naissance</a></span>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Nom et Prenom du père</th>
                                <th>Nom et Prenom de la mère</th>
                                <th>Contacte du Pere</th>
                                <th>sexe de l'enfant</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($declarations as $declaration)
                            <tr>
                                <td>{{ $declaration->heure_naissance }}</td>
                                <td>{{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</td>
                                <td>{{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</td>
                                <td>+223 {{ $declaration->telephone_pere }}</td>
                                <td>M</td>
                                <td>en cour</td>
                                <td>
                                    <a href="{{ route('hopital.naissance.show', $declaration->id_volet) }}"
                                        class="btn btn-sm btn-info">Voir</a>
                                    <a href="{{ route('naissance.edit', $declaration->id_volet) }}"
                                        class="btn btn-sm btn-warning">Modifier</a>

                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="5">Aucune déclaration enregistrée.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection