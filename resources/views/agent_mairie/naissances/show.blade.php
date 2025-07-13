<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Extrait d'Acte de Naissance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 16px; }
        .bordered { border: 1px solid black; padding: 5px; }
        .titre { font-weight: bold; text-align: center; text-transform: uppercase; }
        .section-title { font-weight: bold; margin-top: 10px; }
        .form-group { margin-bottom: 5px; }
    </style>
</head>
<body class="container my-4">
  <div>
<a href="{{ route('agent.dashboard') }}" class="btn btn-light btn-sm">← Retour au dashboard</a>
        </div>
    <div class="text-center">
        <h5>REPUBLIQUE DU MALI</h5>
        <p><em>Un Peuple - Un But - Une Foi</em></p>
        <h4 class="mb-3">Acte de naissance N°{{ $acte->num_acte }}</h4>
        <h6>(Volet N°3 – Original remis au déclarant)</h6>
    </div>

    <div class="bordered my-3">
        <p><strong>Région :</strong> {{ $acte->Commune->region ?? 'N/A' }}</p>
        <p><strong>Cercle :</strong> {{ $acte->Commune->cercle ?? 'N/A' }}</p>
        <p><strong>Commune :</strong> {{ $acte->Commune->nom_commune ?? 'N/A' }}</p>
    </div>

    <h5 class="section-title">ENFANT</h5>
    <div class="bordered">
        <p><strong>Nom :</strong> {{ $acte->nom }}</p>
        <p><strong>Prénom :</strong> {{ $acte->prenom }}</p>
        <p><strong>Date de naissance :</strong> {{ $acte->date_naissance_enfant }}</p>
        <p><strong>Heure de naissance :</strong> {{ $acte->heure_naissance ?? 'Non précisée' }}</p>
        <p><strong>Lieu de naissance :</strong> {{ $acte->lieu_naissance_enfant }}</p>
        <p><strong>Sexe :</strong> {{ $acte->sexe_enfant }}</p>
    </div>

    <h5 class="section-title">PÈRE</h5>
    <div class="bordered">
        <p><strong>Nom :</strong> {{ $acte->nom_pere }}</p>
        <p><strong>Prénom :</strong> {{ $acte->prenom_pere }}</p>
        <p><strong>Profession :</strong> {{ $acte->proffesion_pere }}</p>
        <p><strong>Domicile :</strong> {{ $acte->domicile_pere }}</p>
    </div>

    <h5 class="section-title">MÈRE</h5>
    <div class="bordered">
        <p><strong>Nom :</strong> {{ $acte->nom_mere }}</p>
        <p><strong>Prénom :</strong> {{ $acte->prenom_mere }}</p>
        <p><strong>Profession :</strong> {{ $acte->proffesion_mere }}</p>
        <p><strong>Domicile :</strong> {{ $acte->domicile_mere }}</p>
    </div>

    <h5 class="section-title">DÉCLARANT</h5>
    <div class="bordered">
        <p><strong>Nom :</strong> {{ $acte->declarant->nom_declarant ?? 'N/A' }}</p>
        <p><strong>Prénom :</strong> {{ $acte->declarant->prenom_declarant ?? '' }}</p>
        <p><strong>Profession :</strong> {{ $acte->declarant->profession_declarant ?? 'N/A' }}</p>
        <p><strong>Domicile :</strong> {{ $acte->declarant->domicile_declarant ?? 'N/A' }}</p>
    </div>

    <h5 class="section-title">INFORMATIONS JURIDIQUES</h5>
    <div class="bordered">
        <p><strong>Date d'enregistrement :</strong> {{ $acte->date_enregistrement_acte }}</p>
        <p><strong>Officier d'état civil :</strong> {{ $acte->officier->nom ?? 'N/A' }}</p>
    </div>
    

    <div class="text-end mt-4">
        <p><strong>Fait à :</strong> {{ $acte->lieu_naissance_enfant }}</p>
        <p><strong>Le :</strong> {{ \Carbon\Carbon::parse($acte->date_enregistrement_acte)->format('d/m/Y') }}</p>
    </div>

    <div class="text-end mt-4">
        <p><strong>Signature et cachet de l’officier d’état civil</strong></p>
    </div>
<form action="{{ route('acte.destroy', $acte->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet acte ?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3">Supprimer cet acte</button>
    </form>
</body>
</html>
