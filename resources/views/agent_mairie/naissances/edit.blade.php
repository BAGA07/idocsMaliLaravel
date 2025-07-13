<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Modifier l'acte #{{ $acte->num_acte }}</h5>
            <a href="{{ route('agent.dashboard') }}" class="btn btn-light btn-sm">← Retour au dashboard</a>
        </div>
        <div class="card-body">

            {{-- Affichage des erreurs --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('acte.update', $acte->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Informations de l'enfant --}}
                <div class="row">
                    <div class="col-md-6">
                        <label>Nom de l'enfant</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom', $acte->nom) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Prénom de l'enfant</label>
                        <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $acte->prenom) }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>Date de naissance</label>
                        <input type="date" name="date_naissance_enfant" class="form-control" value="{{ old('date_naissance_enfant', $acte->date_naissance_enfant) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Heure de naissance</label>
                        <input type="time" name="heure_naissance" class="form-control" value="{{ old('heure_naissance', $acte->heure_naissance) }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>Lieu de naissance</label>
                        <input type="text" name="lieu_naissance_enfant" class="form-control" value="{{ old('lieu_naissance_enfant', $acte->lieu_naissance_enfant) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Sexe</label>
                        <select name="sexe_enfant" class="form-select">
                            <option value="masculin" {{ $acte->sexe_enfant == 'masculin' ? 'selected' : '' }}>Masculin</option>
                            <option value="féminin" {{ $acte->sexe_enfant == 'féminin' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>
                </div>

                {{-- Informations du père --}}
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label>Prénom du père</label>
                        <input type="text" name="prenom_pere" class="form-control" value="{{ old('prenom_pere', $acte->prenom_pere) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Nom du père</label>
                        <input type="text" name="nom_pere" class="form-control" value="{{ old('nom_pere', $acte->nom_pere) }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>Profession du père</label>
                        <input type="text" name="profession_pere" class="form-control" value="{{ old('profession_pere', $acte->profession_pere) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Domicile du père</label>
                        <input type="text" name="domicile_pere" class="form-control" value="{{ old('domicile_pere', $acte->domicile_pere) }}">
                    </div>
                </div>

                {{-- Informations de la mère --}}
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label>Prénom de la mère</label>
                        <input type="text" name="prenom_mere" class="form-control" value="{{ old('prenom_mere', $acte->prenom_mere) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Nom de la mère</label>
                        <input type="text" name="nom_mere" class="form-control" value="{{ old('nom_mere', $acte->nom_mere) }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>Profession de la mère</label>
                        <input type="text" name="profession_mere" class="form-control" value="{{ old('profession_mere', $acte->profession_mere) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Domicile de la mère</label>
                        <input type="text" name="domicile_mere" class="form-control" value="{{ old('domicile_mere', $acte->domicile_mere) }}">
                    </div>
                </div>

                {{-- Officier et commune --}}
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label>Officier d’état civil</label>
                        <select name="id_officier" class="form-select">
                            @foreach ($officiers as $officier)
                                <option value="{{ $officier->id }}" {{ $acte->id_officier == $officier->id ? 'selected' : '' }}>
                                    {{ $officier->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Commune</label>
                        <select name="id_commune" class="form-select">
                            @foreach ($communes as $commune)
                                <option value="{{ $commune->id }}" {{ $acte->id_commune == $commune->id ? 'selected' : '' }}>
                                    {{ $commune->nom_commune }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- {{-- Pièce jointe --}}
                <div class="mt-4">
                    <label>Pièce jointe</label>
                    @if ($acte->piece_jointe)
                        <p class="mb-1">
                            Actuelle : 
                            <a href="{{ asset('storage/pieces_jointes/' . $acte->piece_jointe) }}" target="_blank">
                                {{ $acte->piece_jointe }}
                            </a>
                        </p>
                    @endif
                    <input type="file" name="piece_jointe" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                </div> -->

                

                    <div class="mt-4">
            <button type="submit" class="btn btn-success">Modifier</button>
            <a href="{{ route('agent.dashboard') }}" class="btn btn-secondary"> Annuler</a>
        </div>
                </div>
            </form>
        </div>
    </div>
</div>

