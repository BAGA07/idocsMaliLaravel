@extends('layouts.app')

@section('content')
<div class="right_col" role="main">

    {{-- Dashboard pour citoyen --}}
    {{-- @if (session('user')['role'] === 'citoyen') --}}
    <div class="container">
        <section class="welcome-section text-center shadow-lg">
            <h1>Bienvenue <strong>{{-- {{ session('user')['nom'] }} --}}</strong>, sur votre Espace Citoyen</h1>
            <p>Soumettez facilement vos demandes administratives, suivez leur état d’avancement et consultez vos
                documents, en toute sécurité.</p>
            <a href="{{ url('index.php?action=new_demande') }}" class="btn btn-welcome">Faire une nouvelle demande</a>
        </section>
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
                                <th>#</th>
                                <th>Types de demande</th>
                                <th>Justificatifs / Actes</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{-- {{ $i }} --}}</td>
                                <td>Acte de naissance</td>
                                <td>photo</td>
                                <td><span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Validée</span></td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Modifier</a>
                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                        Supprimer</a>
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
</div>
@endsection