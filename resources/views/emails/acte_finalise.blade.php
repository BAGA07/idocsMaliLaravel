<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Notification de finalisation</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111; line-height:1.6;">
    <div style="max-width:620px; margin:0 auto; padding:16px;">
        <h2 style="margin:0 0 12px;">Confirmation de finalisation</h2>

        <?php
            $nomPrenomDeclarant = trim(
                (optional($declarant)->prenom ?? '') . ' ' . (optional($declarant)->nom ?? '')
            );
            if ($nomPrenomDeclarant === '' && isset($demande) && $demande->nom_complet) {
                $nomPrenomDeclarant = $demande->nom_complet;
            }
        ?>

        <p>Bonjour {{ $nomPrenomDeclarant !== '' ? $nomPrenomDeclarant : 'Madame, Monsieur' }},</p>

        <p>
            Nous vous informons que
            @if(($acte->type ?? 'original') === 'copie')
                votre copie/extrait
            @else
                votre acte de naissance
            @endif
            @if(!empty($acte->num_acte))
                n° <strong>{{ $acte->num_acte }}</strong>
            @endif
            a été finalisé le
            <strong>{{ optional($acte->signed_at ?? $acte->finalise_at ?? now())->timezone(config('app.timezone', 'UTC'))->format('d/m/Y H:i') }}</strong>.
        </p>

        <p>Détails:</p>
        <ul>
            @if(!empty($acte->prenom) || !empty($acte->nom))
                <li>Enfant: <strong>{{ $acte->prenom }} {{ $acte->nom }}</strong></li>
            @endif
            @if(!empty($acte->date_naissance_enfant))
                <li>Date de naissance: <strong>{{ \Illuminate\Support\Carbon::parse($acte->date_naissance_enfant)->format('d/m/Y') }}</strong></li>
            @endif
            @if(!empty($acte->lieu_naissance_enfant ?? $acte->lieu_naissance))
                <li>Lieu de naissance: <strong>{{ $acte->lieu_naissance_enfant ?? $acte->lieu_naissance }}</strong></li>
            @endif
            @if(!empty($acte->type))
                <li>Type: <strong>{{ ucfirst($acte->type) }}</strong></li>
            @endif
        </ul>

        <p>
            Pour toute question, vous pouvez répondre à cet e‑mail.
        </p>

        <p style="margin-top:24px;">
            Cordialement,<br>
            L’officier d’état civil
        </p>

        <hr style="border:none; border-top:1px solid #eee; margin:24px 0;">
        <small style="color:#666;">Ceci est un message automatique.</small>
    </div>
</body>
</html>
