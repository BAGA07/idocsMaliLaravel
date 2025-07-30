<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

echo "=== STRUCTURE DE LA TABLE ACTE_NAISSANCE ===\n";

try {
    $columns = DB::select("DESCRIBE acte_naissance");
    
    echo "\nColonnes existantes :\n";
    foreach ($columns as $column) {
        echo "- {$column->Field} ({$column->Type})";
        if ($column->Null === 'NO') {
            echo " NOT NULL";
        }
        if ($column->Default !== null) {
            echo " DEFAULT '{$column->Default}'";
        }
        echo "\n";
    }
    
    // Vérifier spécifiquement les colonnes de signature
    $signatureColumns = ['signature_image', 'signed_at', 'finalized_by_officier_id', 'finalized', 'cachet_applique'];
    
    echo "\nVérification des colonnes de signature :\n";
    foreach ($signatureColumns as $col) {
        $exists = false;
        foreach ($columns as $column) {
            if ($column->Field === $col) {
                $exists = true;
                echo "✅ {$col} existe ({$column->Type})\n";
                break;
            }
        }
        if (!$exists) {
            echo "❌ {$col} n'existe pas\n";
        }
    }
    
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

echo "\n=== FIN ===\n"; 