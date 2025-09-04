<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouvelle demande de copie d'extrait d'acte de naissance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2563eb;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8fafc;
            padding: 20px;
            border: 1px solid #e2e8f0;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #2563eb;
            border-radius: 4px;
        }
        .highlight {
            background-color: #fef3c7;
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
        }
        .footer {
            background-color: #1e40af;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏛️ Nouvelle demande de copie d'extrait d'acte</h1>
        <p>Mairie de {{ $commune->nom_commune }}</p>
    </div>

    <div class="content">
        <p>Bonjour,</p>

        <p>Une nouvelle demande de copie d'extrait d'acte de naissance a été soumise via la plateforme IdocsMali et nécessite votre attention.</p>

        <div class="info-box">
            <h3>📋 Informations de la demande</h3>
            <p><strong>Numéro de suivi :</strong> {{ $demande->numero_suivi }}</p>
            <p><strong>Date de soumission :</strong> {{ $demande->created_at->format('d/m/Y à H:i') }}</p>
            <p><strong>Statut :</strong> {{ $demande->statut }}</p>
            <p><strong>Nombre de copies demandées :</strong> {{ $demande->nombre_copie }}</p>
        </div>

        <div class="info-box">
            <h3>👤 Informations du demandeur</h3>
            <p><strong>Nom complet :</strong> {{ $demande->nom_complet }}</p>
            <p><strong>Email :</strong> {{ $demande->email }}</p>
            <p><strong>Téléphone :</strong> {{ $demande->telephone }}</p>
            <p><strong>Commune :</strong> {{ $commune->nom_commune }} - {{ $commune->cercle }} ({{ $commune->region }})</p>
        </div>

        @if($demande->informations_complementaires)
        <div class="info-box">
            <h3>📝 Informations complémentaires</h3>
            <p>{{ $demande->informations_complementaires }}</p>
        </div>
        @endif

        <div class="highlight">
            <h3>📎 Pièce justificative</h3>
            <p>Une photo de l'extrait d'acte existant a été fournie par le demandeur. Vous pouvez la consulter dans l'interface d'administration de la mairie.</p>
        </div>

        <div style="text-align: center; margin: 20px 0;">
            <a href="{{ route('agent.dashboard') }}" class="btn">
                Accéder à l'interface d'administration
            </a>
        </div>

        <p><strong>Action requise :</strong> Veuillez traiter cette demande dans les plus brefs délais. Le demandeur sera notifié de l'avancement de sa demande.</p>

        <p>Merci pour votre collaboration.</p>
    </div>

    <div class="footer">
        <p>IdocsMali - Plateforme de gestion des actes d'état civil</p>
        <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre directement.</p>
    </div>
</body>
</html>
