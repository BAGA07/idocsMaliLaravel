<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Récupérer toutes les demandes qui ont des justificatifs
        $demandes = DB::table('demandes')
            ->whereNotNull('justificatif')
            ->orWhereNotNull('chemin_justificatif')
            ->get();

        foreach ($demandes as $demande) {
            $cheminJustificatif = null;
            
            // Vérifier si le chemin existe dans le champ justificatif
            if (!empty($demande->justificatif)) {
                $cheminJustificatif = $demande->justificatif;
            }
            // Sinon, vérifier dans le champ chemin_justificatif (si il existe)
            elseif (!empty($demande->chemin_justificatif)) {
                $cheminJustificatif = $demande->chemin_justificatif;
            }

            if ($cheminJustificatif) {
                // Vérifier si le fichier existe dans le stockage
                if (Storage::disk('public')->exists($cheminJustificatif)) {
                    // Le fichier existe, mettre à jour le champ justificatif
                    DB::table('demandes')
                        ->where('id', $demande->id)
                        ->update([
                            'justificatif' => $cheminJustificatif
                        ]);
                } else {
                    // Le fichier n'existe pas, essayer de le trouver dans d'autres dossiers
                    $possiblePaths = [
                        $cheminJustificatif,
                        'justificatifs_copie_extrait/' . basename($cheminJustificatif),
                        'justificatifs/' . basename($cheminJustificatif),
                        'uploads/' . basename($cheminJustificatif),
                        'public/' . $cheminJustificatif,
                    ];

                    $foundPath = null;
                    foreach ($possiblePaths as $path) {
                        if (Storage::disk('public')->exists($path)) {
                            $foundPath = $path;
                            break;
                        }
                    }

                    if ($foundPath) {
                        // Mettre à jour avec le bon chemin
                        DB::table('demandes')
                            ->where('id', $demande->id)
                            ->update([
                                'justificatif' => $foundPath
                            ]);
                    } else {
                        // Marquer comme fichier manquant
                        DB::table('demandes')
                            ->where('id', $demande->id)
                            ->update([
                                'justificatif' => 'FICHIER_MANQUANT_' . basename($cheminJustificatif)
                            ]);
                    }
                }
            }
        }

        // Supprimer le champ chemin_justificatif s'il existe (optionnel)
        if (Schema::hasColumn('demandes', 'chemin_justificatif')) {
            Schema::table('demandes', function (Blueprint $table) {
                $table->dropColumn('chemin_justificatif');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cette migration ne peut pas être annulée car elle corrige des données
        // Mais on peut ajouter le champ chemin_justificatif s'il n'existe pas
        if (!Schema::hasColumn('demandes', 'chemin_justificatif')) {
            Schema::table('demandes', function (Blueprint $table) {
                $table->string('chemin_justificatif')->nullable();
            });
        }
    }
};
