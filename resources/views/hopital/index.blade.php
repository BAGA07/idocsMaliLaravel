@extends('layouts.app')

@section('content')
<div class="right_col" role="main">

    {{-- Dashboard pour citoyen --}}
    {{-- @if (session('user')['role'] === 'citoyen') --}}
    <div class="container">
        <section class="welcome-section text-center shadow-lg">
            <h1>Bienvenue <strong>bagayoko</strong></h1>

            <a href="{{ url('index.php?action=new_demande') }}" class="btn btn-welcome">Faire une nouvelle declaration
                de naissance</a>
        </section>
    </div>


    {{-- Tableau des demandes --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste de vos declaration </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><span><a href="{{ route('form') }}" class="btn btn-primary btn-xs"><i
                                        class="fa fa-plus"></i> Nouvelle
                                    naissance</a></span>
                        </li>
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
                            {{-- Exemple fictif : À remplacer par une boucle @foreach --}}
                            {{-- @for ($i = 1; $i <= 3; $i++) --}} <tr>
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
                                {{-- @endfor --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection