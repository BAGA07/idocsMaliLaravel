<?php

require_once 'vendor/autoload.php';

use App\Models\Acte;

echo "=== TEST DE LA SIGNATURE ===\n";

try {
    // Vérifier si on peut trouver une copie à finaliser
    $copie = Acte::where('type', 'copie')
        ->where('statut', 'En attente de signature')
        ->first();
    
    if ($copie) {
        echo "✅ Copie trouvée pour test :\n";
        echo "- ID: {$copie->id}\n";
        echo "- Numéro: {$copie->num_acte}\n";
        echo "- Statut: {$copie->statut}\n";
        echo "- Type: {$copie->type}\n";
        
        // Test de mise à jour
        $testSignature = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==";
        
        $copie->signature_image = $testSignature;
        $copie->signed_at = now();
        $copie->finalized_by_officier_id = 1;
        $copie->finalized = true;
        $copie->cachet_applique = true;
        $copie->statut = 'Finalisé';
        
        $saved = $copie->save();
        
        if ($saved) {
            echo "✅ Signature sauvegardée avec succès\n";
            
            // Vérifier que les données sont bien sauvegardées
            $copieRefresh = Acte::find($copie->id);
            echo "- Signature sauvegardée: " . (strlen($copieRefresh->signature_image) > 0 ? "OUI" : "NON") . "\n";
            echo "- Statut mis à jour: {$copieRefresh->statut}\n";
            echo "- Finalisé: " . ($copieRefresh->finalized ? "OUI" : "NON") . "\n";
            
            // Remettre en attente pour les tests
            $copieRefresh->statut = 'En attente de signature';
            $copieRefresh->finalized = false;
            $copieRefresh->save();
            echo "✅ Remis en attente pour les tests\n";
        } else {
            echo "❌ Erreur lors de la sauvegarde\n";
        }
    } else {
        echo "❌ Aucune copie en attente de signature trouvée\n";
        
        // Lister toutes les copies
        $copies = Acte::where('type', 'copie')->get();
        echo "\nCopies existantes :\n";
        foreach ($copies as $c) {
            echo "- ID: {$c->id}, Numéro: {$c->num_acte}, Statut: {$c->statut}\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    echo "Trace : " . $e->getTraceAsString() . "\n";
}

echo "\n=== FIN DU TEST ===\n"; 