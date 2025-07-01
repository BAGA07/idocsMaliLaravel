@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="container mt-5">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card shadow rounded">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="fa fa-user-plus"></i> Ajouter un nouveau Manager</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('managers.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-user"></i> Nom</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="nom" class="form-control" placeholder="Ex: Diarra" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-user"></i> Prénom</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="prenom" class="form-control" placeholder="Ex: Fatou" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-map-marker"></i> Adresse</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="adresse" class="form-control" placeholder="Ex: Badialan"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-phone"></i> Téléphone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                <input type="text" name="telephone" class="form-control" placeholder="Ex: +223 92459396"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-envelope"></i> Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Ex: manager@idocs.ml"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-lock"></i> Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="********"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label><i class="fa fa-building"></i> Structure</label>
                        <select name="structure" id="structure" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="hopital">Hôpital</option>
                            <option value="mairie">Mairie</option>
                        </select>
                    </div>

                    <div class="mb-3" id="select_hopital" style="display: none;">
                        <label>Hôpital concerné</label>
                        <select name="structure_id" class="form-select" disabled>
                            @foreach($hopitaux as $hopital)
                            <option value="{{ $hopital->id }}">{{ $hopital->nom_hopital }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3" id="select_mairie" style="display: none;">
                        <label>Mairie concernée</label>
                        <select name="structure_id" class="form-select" disabled>
                            @foreach($mairies as $mairie)

                            <option value="{{ $mairie->id }}">{{ $mairie->nom_mairie }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-end mt-4">
                        <button type="reset" class="btn btn-secondary">
                            <i class="fa fa-undo"></i> Réinitialiser
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Enregistrer le manager
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const structureSelect = document.getElementById('structure');
        const hopitalDiv = document.getElementById('select_hopital');
        const mairieDiv = document.getElementById('select_mairie');

        const hopitalSelect = hopitalDiv.querySelector('select');
        const mairieSelect = mairieDiv.querySelector('select');

        function toggleStructureFields() {
            const selectedValue = structureSelect.value;

            if (selectedValue === 'hopital') {
                hopitalDiv.style.display = 'block';
                mairieDiv.style.display = 'none';

                hopitalSelect.disabled = false;
                mairieSelect.disabled = true;
            } else if (selectedValue === 'mairie') {
                hopitalDiv.style.display = 'none';
                mairieDiv.style.display = 'block';

                hopitalSelect.disabled = true;
                mairieSelect.disabled = false;
            } else {
                hopitalDiv.style.display = 'none';
                mairieDiv.style.display = 'none';

                hopitalSelect.disabled = true;
                mairieSelect.disabled = true;
            }
        }

        structureSelect.addEventListener('change', toggleStructureFields);

        // Initialisation au chargement
        toggleStructureFields();
    });
    </script>

</div>
@endsection