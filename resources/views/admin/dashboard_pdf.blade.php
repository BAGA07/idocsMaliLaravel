<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques Dashboard Admin</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 15px; color: #222; }
        h2 { color: #2563EB; text-align: center; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        th, td { border: 1px solid #ddd; padding: 8px 12px; }
        th { background: #f0f4fa; color: #2563EB; }
        tr:nth-child(even) { background: #f9f9f9; }
        .section-title { font-size: 1.1em; color: #059669; margin-top: 18px; }
    </style>
</head>
<body>
    <h2>Statistiques Dashboard Administrateur</h2>
    <p><strong>Période :</strong> {{ ucfirst($periode) }}</p>
    <table>
        <tr><th>Statistique</th><th>Valeur</th></tr>
        <tr><td>Documents traités</td><td>{{ $totalDocuments }}</td></tr>
        <tr><td>En attente</td><td>{{ $documentsEnAttente }}</td></tr>
        <tr><td>Structures</td><td>{{ $totalStructures }}</td></tr>
        <tr><td>Utilisateurs</td><td>{{ $totalUsers }}</td></tr>
    </table>
    <div class="section-title">Statut des Demandes</div>
    <table>
        <tr><th>Statut</th><th>Nombre</th></tr>
        @foreach($statsByStatus as $statut => $total)
            <tr><td>{{ $statut }}</td><td>{{ $total }}</td></tr>
        @endforeach
    </table>
    <p style="text-align:center; color:#888; font-size:0.95em;">Généré le {{ now()->format('d/m/Y à H:i') }}</p>
</body>
</html> 