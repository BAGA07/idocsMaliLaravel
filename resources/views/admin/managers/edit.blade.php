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
                <h4 class="mb-0"><i class="fa fa-edit"></i> Modifier le Manager</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('managers.update', $manager->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-user"></i> Nom</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="nom" class="form-control" value="{{ $manager->nom }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-user"></i> Prénom</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="prenom" class="form-control" value="{{ $manager->prenom }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-map-marker"></i> Adresse</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="adresse" class="form-control" value="{{ $manager->adresse }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-phone"></i> Téléphone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                <input type="text" name="telephone" class="form-control"
                                    value="{{ $manager->telephone }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-envelope"></i> Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" value="{{ $manager->email }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fa fa-lock"></i> Nouveau mot de passe (facultatif)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Laisser vide pour ne pas changer">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label><i class="fa fa-building"></i> Structure</label>
                        <select name="structure" id="structure" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="hopital" {{ $manager->id_hopital ? 'selected' : '' }}>Hôpital</option>
                            <option value="mairie" {{ $manager->id_mairie ? 'selected' : '' }}>Mairie</option>
                        </select>
                    </div>

                    <div class="mb-3" id="select_hopital" style="display: none;">
                        <label>Hôpital concerné</label>
                        <select name="structure_id" class="form-select" id="hopital_select">
                            @foreach($hopitaux as $hopital)
                            <option value="{{ $hopital->id }}" {{ $manager->id_hopital == $hopital->id ? 'selected' : ''
                                }}>
                                {{ $hopital->nom_hopital }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3" id="select_mairie" style="display: none;">
                        <label>Mairie concernée</label>
                        <select name="structure_id" class="form-select" id="mairie_select">
                            @foreach($mairies as $mairie)
                            <option value="{{ $mairie->id }}" {{ $manager->id_mairie == $mairie->id_mairie ?
                                'selected' : '' }}>
                                {{ $mairie->nom_mairie }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('managers.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fa fa-save"></i> Mettre à jour le manager
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
            const hopitalSelect = document.getElementById('hopital_select');
            const mairieSelect = document.getElementById('mairie_select');

            function toggleStructureFields() {
                const selected = structureSelect.value;
                if (selected === 'hopital') {
                    hopitalDiv.style.display = 'block';
                    hopitalSelect.disabled = false;

                    mairieDiv.style.display = 'none';
                    mairieSelect.disabled = true;
                } else if (selected === 'mairie') {
                    hopitalDiv.style.display = 'none';
                    hopitalSelect.disabled = true;

                    mairieDiv.style.display = 'block';
                    mairieSelect.disabled = false;
                } else {
                    hopitalDiv.style.display = 'none';
                    mairieDiv.style.display = 'none';
                    hopitalSelect.disabled = true;
                    mairieSelect.disabled = true;
                }
            }

            structureSelect.addEventListener('change', toggleStructureFields);
            toggleStructureFields(); // Initialisation au chargement
        });
    </script>
</div>
@endsection