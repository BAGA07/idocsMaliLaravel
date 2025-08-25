<?php

namespace App\Http\Controllers;

use App\Models\Acte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Demande;

class OfficierActeController extends Controller
{
    // Dashboard : liste des actes à finaliser
    public function dashboard()
    {
        // Actes originaux à finaliser (non finalisés et non en attente de signature)
        $actes = \App\Models\Acte::where('type', 'original')
            ->where(function($q) {
                $q->whereNull('statut')->orWhereNotIn('statut', ['En attente de signature', 'Finalisé']);
            })->get();

        // Copies/extraits en attente de signature par l'officier
        $copiesEnAttente = \App\Models\Acte::where('type', 'copie')
            ->where('statut', 'En attente de signature')
            ->get();

        // Historique des actes originaux finalisés
        $actesFinalises = \App\Models\Acte::where('type', 'original')
            ->where('statut', 'Finalisé')
            ->get();

        // Historique des copies/extraits finalisés
        $copiesFinalisees = \App\Models\Acte::where('type', 'copie')
            ->where('statut', 'Finalisé')
            ->get();

        return view('officier.dashboard', compact('actes', 'copiesEnAttente', 'actesFinalises', 'copiesFinalisees'));
    }

    // Affichage du formulaire de finalisation (signature électronique)
    public function showFinalisation($id)
    {
        $acte = Acte::findOrFail($id);
        return view('officier.finaliser', compact('acte'));
    }

    // Enregistrement de la signature électronique et finalisation
    public function finaliser(Request $request, $id)
    {
        $request->validate([
            'signature_image' => 'required|string', // base64
        ]);
        $acte = \App\Models\Acte::findOrFail($id);
        $acte->signature_image = $request->signature_image; // Enregistre la signature électronique
        $acte->signed_at = now();
        $acte->finalized_by_officier_id = \Auth::id();
        $acte->finalized = true;
        $acte->cachet_applique = true;
        $acte->statut = 'Finalisé';
        $acte->save();
        //Envoie du mail au declarant
         try {
            $email = optional($acte->declarant)->email
                ?? optional($acte->demande)->email
                ?? null;

            if ($email) {
                \Mail::to($email)->send(new \App\Mail\ActeFinaliseMail($acte));
                \Log::info('Email acte finalisé envoyé au déclarant', [
                    'acte_id' => $acte->id,
                    'email' => $email,
                ]);
            } else {
                \Log::warning('Aucun email pour le déclarant/demande; notification non envoyée', [
                    'acte_id' => $acte->id,
                ]);
            }
        } catch (\Throwable $e) {
            \Log::error('Erreur lors de l\'envoi de l\'email (finalisation acte)', [
                'acte_id' => $acte->id,
                'error' => $e->getMessage(),
            ]);
        }
        return redirect()->route('officier.dashboard')->with('success', 'Acte finalisé avec succès.');
    }

    // Génération du PDF de l'acte finalisé
    public function generatePdf($id)
    {
        $acte = Acte::findOrFail($id);
        $pdf = Pdf::loadView('officier.finaliser', compact('acte'));
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);
        $filename = 'acte_naissance_' . str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '', $acte->num_acte) . '.pdf';
        return $pdf->download($filename);
    }

    // Affichage du formulaire de finalisation pour copie/extrait
    public function showFinalisationCopie($id)
    {
        $copie = Acte::findOrFail($id);
        return view('officier.finaliser_copie', compact('copie'));
    }
    //show de l'acte originale signe par l'officier
     public function show(string $id)
    {
        // Cette méthode doit pouvoir afficher les détails d'un acte original ou d'une copie
        $acte = Acte::with(['demande.volet', 'Commune', 'declarant', 'officier'])->findOrFail($id);
        return view('officier.showActe', compact('acte'));
    }
//show de la copie signe par l'officier
 public function showCopie($id)
    {
        $copie = Acte::with(['declarant', 'demande', 'Commune', 'officier'])
            ->where('type', 'copie')
            ->findOrFail($id);

        return view('officier.show', compact('copie'));
    }
    // Enregistrement de la signature électronique et finalisation pour copie/extrait
    public function finaliserCopie(Request $request, $id)
    {
        try {
            \Log::info('Début finalisation copie', [
                'copie_id' => $id,
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);

            $request->validate([
                'signature_image' => 'required|string', // base64
            ]);

            $copie = \App\Models\Acte::findOrFail($id);

            \Log::info('Copie trouvée', [
                'copie_id' => $copie->id,
                'copie_num_acte' => $copie->num_acte,
                'signature_length' => strlen($request->signature_image)
            ]);

            $copie->signature_image = $request->signature_image; // Enregistre la signature électronique
            $copie->signed_at = now();
            $copie->finalized_by_officier_id = \Auth::id();
            $copie->finalized = true;
            $copie->cachet_applique = true;
            $copie->statut = 'Finalisé';
            $copie->save();
            // Envoi de l'email au déclarant/demandeur pour la copie
            try {
                $email = optional($copie->declarant)->email
                    ?? optional($copie->demande)->email
                    ?? null;

                if ($email) {
                    \Mail::to($email)->send(new \App\Mail\ActeFinaliseMail($copie));
                    \Log::info('Email copie/extrait finalisé envoyé', [
                        'acte_id' => $copie->id,
                        'email' => $email,
                    ]);
                } else {
                    \Log::warning('Aucun email pour le déclarant/demandeur; notification non envoyée (copie)', [
                        'acte_id' => $copie->id,
                    ]);
                }
            } catch (\Throwable $e) {
                \Log::error('Erreur lors de l\'envoi de l\'email (finalisation copie)', [
                    'acte_id' => $copie->id,
                    'error' => $e->getMessage(),
                ]);
            }
            \Log::info('Copie finalisée avec succès', [
                'copie_id' => $copie->id,
                'statut' => $copie->statut
            ]);

            return redirect()->route('officier.dashboard')->with('success', 'Copie/Extrait finalisé avec succès.Un email de notification a été envoyé.');
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la finalisation de la copie', [
                'copie_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Erreur lors de la finalisation: ' . $e->getMessage());
        }
    }

    // Génération du PDF de la copie/extrait finalisé
    public function generatePdfCopie($id)
    {
        $copie = Acte::findOrFail($id);
        $pdf = Pdf::loadView('officier.pdf_copie', compact('copie'));
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);
        $filename = 'copie_extrait_' . str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '', $copie->num_acte) . '.pdf';
        return $pdf->download($filename);
    }

    public function historique()
    {
        $actesFinalises = \App\Models\Acte::where('type', 'original')->where('statut', 'Finalisé')->get();
        $copiesFinalisees = \App\Models\Acte::where('type', 'copie')->where('statut', 'Finalisé')->get();
        return view('officier.historique', compact('actesFinalises', 'copiesFinalisees'));
    }
}
