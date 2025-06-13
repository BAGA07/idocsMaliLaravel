@extends('layouts.app')

@section('content')
<div class="right_col" role="main">

    {{-- Dashboard pour citoyen --}}
    {{-- @if (session('user')['role'] === 'citoyen') --}}
    <div class="container">
        <section class="welcome-section text-center shadow-lg">
            <h1>Bienvenue <strong>{{-- {{ session('user')['nom'] }} --}}</strong>, sur votre Espace Officiel</h1>
            <p>Traitter facilement vos demandes administratives.</p>
            <a href="{{ url('index.php?action=new_demande') }}" class="btn btn-welcome">Faire une nouvelle demande</a>
        </section>
    </div>

    <div class="row mt-4">
        {{-- Statistique - Total des demandes --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-file-text-o"></i></div>
                <div class="count">23</div>
                <h3>Total des demandes</h3>
                <p>Depuis votre inscription</p>
            </div>
        </div>

        {{-- Statistique - Demandes validées --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-circle"></i></div>
                <div class="count">23</div>
                <h3>Demandes validées</h3>
                <p>Prêtes à être retirées ou téléchargées</p>
            </div>
        </div>

        {{-- Statistique - Demandes en attente --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-hourglass-half"></i></div>
                <div class="count">34</div>
                <h3>En attente</h3>
                <p>En cours de traitement</p>
            </div>
        </div>
    </div>

    {{-- Tableau des demandes --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste de vos demandes <small>Suivi en temps réel</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Types de demande</th>
                                <th>Provenance</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>6 mn</td>
                                <td>Acte de naissance</td>
                                <td>Hopital du mali</td>
                                <td>En attente</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Modifier</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Section Famille --}}
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="x_panel fixed_height_390">
                <div class="x_content">
                    <div class="flex">
                        <ul class="list-inline widget_profile_box">
                            <li><a><i class="fa fa-facebook"></i></a></li>
                            <li><img src="{{ asset('gentelella/assets/images/user.png') }}" alt="..."
                                    class="img-circle profile_img"></li>
                            <li>
                                <button type="button" class="btn btn-round btn-primary">
                                    <i class="fa fa-plus"></i> Nouveau
                                </button>
                            </li>
                        </ul>
                    </div>

                    <h3 class="name">Ma Famille</h3>

                    <div class="flex">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Lien De parenté</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Exemple fictif --}}
                                <tr>
                                    <td>BAGAYOKO</td>
                                    <td>Aboubacar</td>
                                    <td>Père</td>
                                    <td>Actif</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                            Modifier</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <p>Pour ajouter un membre de votre famille, cliquez sur "Nouveau".</p>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}

    {{-- Dashboard pour admin --}}
    {{-- @if (session('user')['role'] === 'admin')
    <div class="row">
        <div class="tile_count">
            <div class="col-md-4 col-sm-4 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total des utilisateurs</span>
                <div class="count">2500</div>
                <span class="count_bottom"><i class="green">+4% </i> depuis la semaine dernière</span>
            </div>
            <div class="col-md-4 col-sm-4 tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> Demandes en attente</span>
                <div class="count">123</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> 3%</i> depuis la semaine
                    dernière</span>
            </div>
            <div class="col-md-4 col-sm-4 tile_stats_count">
                <span class="count_top"><i class="glyphicon glyphicon-ok"></i> Demandes traitées</span>
                <div class="count green">2,500</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> 34% </i> depuis la semaine
                    dernière</span>
            </div>
        </div>
    </div> --}}

    {{-- Autres sections pour l’admin à compléter ici --}}
    {{-- @endif --}}
</div>
@endsection