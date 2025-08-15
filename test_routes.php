<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Route;

echo "=== TEST DES ROUTES ===\n";

// Routes pour l'officier
$officierRoutes = [
    'officier.dashboard',
    'officier.finaliser',
    'officier.finaliser.store',
    'officier.finaliser.copie',
    'officier.finaliser.copie.store',
    'officier.copies.finaliser',
    'officier.copies.finaliser.post',
    'officier.pdf',
    'officier.pdf.copie',
    'officier.actes.pdf',
    'officier.copies.pdf',
    'officier.historique'
];

echo "\nRoutes pour l'officier :\n";
foreach ($officierRoutes as $routeName) {
    try {
        $url = route($routeName, ['id' => 1]);
        echo "✅ $routeName -> $url\n";
    } catch (Exception $e) {
        echo "❌ $routeName -> ERREUR: " . $e->getMessage() . "\n";
    }
}

// Routes pour l'agent mairie
$mairieRoutes = [
    'mairie.dashboard.actes',
    'mairie.dashboard.copies',
    'copies.show',
    'copies.envoyer_officier',
    'acte.envoyer_officier'
];

echo "\nRoutes pour l'agent mairie :\n";
foreach ($mairieRoutes as $routeName) {
    try {
        $url = route($routeName, ['id' => 1]);
        echo "✅ $routeName -> $url\n";
    } catch (Exception $e) {
        echo "❌ $routeName -> ERREUR: " . $e->getMessage() . "\n";
    }
}

echo "\n=== FIN DU TEST ===\n"; 