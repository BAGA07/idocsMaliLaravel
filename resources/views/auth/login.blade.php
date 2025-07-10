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

                        {{-- ✅ Message flash (ex : déconnexion réussie) --}}
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        {{-- ❌ Erreurs générales (identifiants incorrects par exemple) --}}
                        @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div>
                        @endif

                        {{-- ✅ Champ email avec message d'erreur --}}
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="Votre email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- ✅ Champ mot de passe avec message d'erreur --}}
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe"
                                required>
                            @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- ✅ Bouton de soumission + lien mot de passe oublié --}}
                        <div>
                            <button type="submit" class="btn btn-default submit">Se connecter</button>
                            @if (Route::has('password.request'))
                            <a class="reset_pass" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Vous êtes nouveau ?
                                <a href="{{ route('register') }}" class="to_register">Créer un compte</a>
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