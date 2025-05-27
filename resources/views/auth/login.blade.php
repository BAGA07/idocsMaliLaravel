@extends('layouts.auth')

@section('content')
<div class="login_wrapper">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">

            {{-- LOGIN FORM --}}
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1>Formulaire de connexion</h1>

                        <div>
                            <input type="email" name="email" class="form-control" placeholder="Votre email" required
                                value="{{ old('email') }}" />
                        </div>

                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe"
                                required />
                        </div>

                        <div>
                            <button type="submit" class="btn btn-default submit">Se connecter</button>
                            @if (Route::has('password.request'))
                            <a class="reset_pass" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Vous êtes nouveau ?
                                <a href="#signup" class="to_register">Créer un compte</a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-edit"></i> IDocsMali!</h1>
                                <p>©2025 Tous droits réservés</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            {{-- REGISTER FORM --}}
            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1>Créer un compte</h1>

                        <div>
                            <input type="text" class="form-control" placeholder="Nom" name="nom" required
                                value="{{ old('nom') }}" />
                        </div>

                        <div>
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom" required
                                value="{{ old('prenom') }}" />
                        </div>

                        <div>
                            <input type="text" class="form-control" placeholder="Adresse" name="adresse" required
                                value="{{ old('adresse') }}" />
                        </div>

                        <div>
                            <input type="text" class="form-control" placeholder="Téléphone" name="telephone" required
                                value="{{ old('telephone') }}" />
                        </div>

                        <div>
                            <input type="email" class="form-control" placeholder="Email" name="email" required
                                value="{{ old('email') }}" />
                        </div>

                        <div>
                            <input type="password" class="form-control" placeholder="Mot de passe" name="password"
                                required />
                        </div>

                        <div>
                            <input type="password" class="form-control" placeholder="Confirmer le mot de passe"
                                name="password_confirmation" required />
                        </div>

                        <div>
                            <button type="submit" class="btn btn-default submit">S'inscrire</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Vous avez déjà un compte ?
                                <a href="#signin" class="to_register">Connectez-vous</a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-edit"></i> IDocsMali!</h1>
                                <p>©2025 Tous droits réservés</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

        </div>
    </div>
</div>
@endsection