@extends('layouts.presentation')
@section('links')
<link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/form.css') }}">
@endsection
@section('content')
<div class="form-container">
    <h2>Demande de copie d’acte de naissance</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="acte_original">Téléversez l’acte de naissance original (scan ou photo)</label>
        <input type="file" id="acte_original" name="acte_original" accept="image/*,application/pdf" required>

        <label for="nombre_copies">Nombre de copies souhaitées</label>
        <input type="number" id="nombre_copies" name="nombre_copies" min="1" value="1" required>

        <label for="format">Format souhaité</label>
        <select id="format" name="format" required>
            <option value="papier">Copie papier</option>
            <option value="numerique">Copie numérique (PDF)</option>
            <option value="les_deux">Les deux</option>
        </select>

        <label for="adresse_livraison">Adresse de livraison (si copie papier)</label>
        <input type="text" id="adresse_livraison" name="adresse_livraison">

        <button type="submit">Envoyer la demande</button>
    </form>
</div>
@endsection