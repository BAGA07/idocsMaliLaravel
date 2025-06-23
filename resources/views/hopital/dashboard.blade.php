@extends('layouts.app')

@section('content')
<div class="right_col" role="main">

    {{-- Dashboard pour citoyen --}}
    {{-- @if (session('user')['role'] === 'citoyen') --}}
    <div class="container">
        <section class="welcome-section text-center shadow-lg">
            <h1>Bonne journée <strong>{{ Auth::user()->nom }}</strong></h1>

            <a href="" class="btn btn-welcome">Faire une nouvelle declaration
                de naissance</a>
        </section>
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
                            <tr>
                                <td>Il 3mn</td>
                                <td>Ousmane Touré</td>
                                <td>Mariame Coulibaly</td>
                                <td>+223 92459395</td>
                                <td>M</td>
                                <td>en cour</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Voir</a>
                                </td>
                            </tr>
                            {{-- @endfor --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection