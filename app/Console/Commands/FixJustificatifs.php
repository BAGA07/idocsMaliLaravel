<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Demande;
use Illuminate\Support\Facades\Storage;

class FixJustificatifs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:justificatifs {--dry-run : Afficher seulement les problèmes sans les corriger}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnostiquer et corriger les problèmes de justificatifs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Diagnostic des justificatifs...');
        
        $demandes = Demande::whereNotNull('justificatif')->get();
        $this->info("📊 Total des demandes avec justificatifs : {$demandes->count()}");
        
        $problemes = [];
        $corrections = [];
        
        foreach ($demandes as $demande) {
            $chemin = $demande->justificatif;
            
            // Vérifier si le fichier existe
            if (!Storage::disk('public')->exists($chemin)) {
                $problemes[] = [
                    'id' => $demande->id,
                    'chemin' => $chemin,
                    'type' => 'FICHIER_MANQUANT'
                ];
                
                // Essayer de trouver le fichier dans d'autres emplacements
                $fichierTrouve = $this->trouverFichier($chemin);
                if ($fichierTrouve) {
                    $corrections[] = [
                        'id' => $demande->id,
                        'ancien_chemin' => $chemin,
                        'nouveau_chemin' => $fichierTrouve
                    ];
                }
            }
        }
        
        // Afficher les problèmes
        if (!empty($problemes)) {
            $this->warn("❌ Problèmes détectés : " . count($problemes));
            foreach ($problemes as $probleme) {
                $this->line("   - Demande ID {$probleme['id']}: {$probleme['chemin']} ({$probleme['type']})");
            }
        } else {
            $this->info("✅ Aucun problème détecté !");
        }
        
        // Afficher les corrections possibles
        if (!empty($corrections)) {
            $this->info("🔧 Corrections possibles : " . count($corrections));
            foreach ($corrections as $correction) {
                $this->line("   - Demande ID {$correction['id']}: {$correction['ancien_chemin']} → {$correction['nouveau_chemin']}");
            }
            
            if (!$this->option('dry-run')) {
                if ($this->confirm('Voulez-vous appliquer ces corrections ?')) {
                    $this->appliquerCorrections($corrections);
                }
            }
        }
        
        // Afficher les statistiques du stockage
        $this->afficherStatistiquesStockage();
    }
    
    private function trouverFichier($chemin)
    {
        $nomFichier = basename($chemin);
        $dossiersPossibles = [
            'justificatifs_copie_extrait',
            'justificatifs',
            'uploads',
            'public',
            'images',
            'files'
        ];
        
        foreach ($dossiersPossibles as $dossier) {
            $cheminTest = $dossier . '/' . $nomFichier;
            if (Storage::disk('public')->exists($cheminTest)) {
                return $cheminTest;
            }
        }
        
        return null;
    }
    
    private function appliquerCorrections($corrections)
    {
        $this->info("🔄 Application des corrections...");
        
        foreach ($corrections as $correction) {
            $demande = Demande::find($correction['id']);
            if ($demande) {
                $demande->justificatif = $correction['nouveau_chemin'];
                $demande->save();
                $this->line("   ✅ Demande ID {$correction['id']} corrigée");
            }
        }
        
        $this->info("✅ Corrections appliquées avec succès !");
    }
    
    private function afficherStatistiquesStockage()
    {
        $this->info("\n📁 Statistiques du stockage :");
        
        $dossiers = [
            'justificatifs_copie_extrait',
            'justificatifs',
            'uploads',
            'public'
        ];
        
        foreach ($dossiers as $dossier) {
            if (Storage::disk('public')->exists($dossier)) {
                $fichiers = Storage::disk('public')->files($dossier);
                $this->line("   - {$dossier}: " . count($fichiers) . " fichiers");
            } else {
                $this->line("   - {$dossier}: dossier inexistant");
            }
        }
    }
}
