<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Copie/Extrait - PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .section { margin-bottom: 20px; }
        .cachet { width: 100px; }
        .signature { width: 200px; border: 1px solid #ccc; }
        .infos { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Copie/Extrait d'Acte</h2>
    <div class="section infos">
        <strong>Numéro acte :</strong> {{ $copie->num_acte ?? '-' }}<br>
        <strong>Nom enfant :</strong> {{ $copie->prenom ?? '-' }} {{ $copie->nom ?? '-' }}<br>
        <strong>Date naissance :</strong> {{ $copie->date_naissance_enfant ?? '-' }}<br>
    </div>
    <div class="section">
        <strong>Finalisé par :</strong> {{ optional($copie->officier)->prenom ?? '' }} {{ optional($copie->officier)->nom ?? '' }}<br>
        <strong>Date de signature :</strong> {{ $copie->signed_at ? \Carbon\Carbon::parse($copie->signed_at)->format('d/m/Y H:i') : '' }}
    </div>
    <div class="section">
        <strong>Signature électronique de l'officier :</strong><br>
        @if($copie->signature_image)
            <img src="{{ $copie->signature_image }}" alt="Signature" class="signature">
        @else
            <em>Non signée</em>
        @endif
    </div>
    <div class="section">
        <strong>Cachet officiel :</strong><br>
        @if($copie->cachet_applique)
            <img src="images/cacher.png" alt="Cachet" class="cachet">
        @else
            <em>Non apposé</em>
        @endif
    </div>

    @if($copie->token)
    <div style="position: absolute; bottom: 20px; left: 20px; z-index: 10;">
        <div style="display:inline-block; padding:0;">
            <div style="font-size:0.8em; color:#222; font-weight:bold; margin-bottom:4px; text-align:center;">Vérification</div>
            <div style="margin-bottom:4px;">
                {!! QrCode::size(60)->generate(url('/verifier-document/' . $copie->token)) !!}
            </div>
            <div style="font-size:0.7em; color:#222; text-align:center;">Scannez pour vérifier</div>
        </div>
    </div>
    @endif
</body>
</html> 