{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
--}}



@extends('layouts.auth')

@section('content')
{{-- REGISTER FORM --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="login_wrapper">
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
                <input type="password" class="form-control" placeholder="Mot de passe" name="password" required />
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
@endsection