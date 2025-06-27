@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Profil de l'utilisateur</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <!-- Colonne gauche : Informations utilisateur -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Profil</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <img class="img-circle profile_img"
                                    src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"
                                    alt="Photo de profil"
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                            </div>
                        </div>

                        <h3>{{ Auth::user()->name }}</h3>

                        <ul class="list-unstyled user_data">
                            <li><i class="fa fa-envelope user-profile-icon"></i> {{ Auth::user()->email }}</li>
                            <li><i class="fa fa-phone user-profile-icon"></i> {{ Auth::user()->telephone ?? 'Non
                                renseigné' }}</li>
                            <li><i class="fa fa-briefcase user-profile-icon"></i> Rôle : {{ Auth::user()->role }}</li>
                        </ul>

                        <a class="btn btn-success" href="#"><i class="fa fa-edit m-right-xs"></i> Modifier le profil</a>
                    </div>
                </div>
            </div>

            <!-- Colonne droite : Formulaire de mise à jour -->
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Mettre à jour le profil</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                            class="form-horizontal form-label-left">
                            @csrf
                            @method('PUT')

                            {{-- Nom --}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nom</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="nom" class="form-control" value="{{ $user->nom }}">
                                </div>
                            </div>

                            {{-- Prénom --}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Prénom</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="prenom" class="form-control" value="{{ $user->prenom }}">
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>

                            {{-- Téléphone --}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Téléphone</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="telephone" class="form-control"
                                        value="{{ $user->telephone }}">
                                </div>
                            </div>

                            {{-- Photo de profil --}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo de profil</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="file" name="photo" class="form-control">
                                    @if ($user->photo)
                                    <img src="{{ asset($user->photo) }}" alt="Photo actuelle"
                                        style="margin-top: 10px; width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 1px solid #ccc;">
                                    @endif
                                </div>
                            </div>

                            <div class="ln_solid"></div>

                            {{-- Boutons --}}
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection