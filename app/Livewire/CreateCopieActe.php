<?php

namespace App\Livewire;

use App\Models\Acte;
use App\Models\Demande;
use App\Models\Commune;
use App\Models\Officier;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateCopieActe extends Component
{
    public $demandeId;
    public $demande;
    public $communes;
    public $officiers;
    public $isVoletCopy;
    public $volet;
    public $urlJustificatif;

    // Champs du formulaire
    public $numActe = '';
    public $prenomEnfant = '';
    public $nomEnfant = '';
    public $dateNaissanceEnfant = '';
    public $lieuNaissanceEnfant = '';
    public $heureNaissance = '';
    public $sexeEnfant = '';
    public $prenomPere = '';
    public $nomPere = '';
    public $professionPere = '';
    public $domicilePere = '';
    public $prenomMere = '';
    public $nomMere = '';
    public $professionMere = '';
    public $domicileMere = '';
    public $idOfficier = '';
    public $idCommune = '';

    // Vérification du numéro d'acte
    public $acteExists = false;
    public $existingActe = null;

    public function mount($id, $demande = null, $communes = null, $officiers = null, $urlJustificatif = null, $isVoletCopy = false, $volet = null)
    {
        $this->demandeId = $id;

        // Si les données sont passées directement, les utiliser
        if ($demande) {
            $this->demande = $demande;
            $this->communes = $communes;
            $this->officiers = $officiers;
            $this->urlJustificatif = $urlJustificatif;
            $this->isVoletCopy = $isVoletCopy;
            $this->volet = $volet;
        } else {
            // Sinon, charger les données normalement
            $this->loadDemande();
        }

        $this->loadFormData();
    }

    public function loadDemande()
    {
        $this->demande = Demande::findOrFail($this->demandeId);

        // Vérifier les autorisations
        if (!Auth::check() || !Auth::user()->hasRole('agent_mairie')) {
            return redirect()->route('login')->withErrors('Accès non autorisé.');
        }

        if ($this->demande->type_document !== 'Extrait de naissance' || $this->demande->statut !== 'En attente') {
            return redirect()->back()->withErrors('Cette demande n\'est pas une demande de copie en attente ou a déjà été traitée.');
        }

        $this->isVoletCopy = !empty($this->demande->id_volet);

        if ($this->isVoletCopy) {
            $this->volet = $this->demande->volet;
            if (!$this->volet) {
                return redirect()->back()->withErrors('Le volet de déclaration associé à cette demande n\'a pas été trouvé.');
            }
        } else {
            if ($this->demande->justificatif) {
                $this->urlJustificatif = url('/storage/' . $this->demande->justificatif);
            }
        }

        $this->communes = Commune::all();
        $this->officiers = Officier::all();
    }

    public function loadFormData()
    {
        if ($this->isVoletCopy && $this->volet) {
            $annee = date('Y');
            $numeroActe = '1729/MCVI/REG/' . $annee . '/' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

            $this->numActe = $numeroActe;
            $this->prenomEnfant = $this->volet->prenom_enfant ?? '';
            $this->nomEnfant = $this->volet->nom_enfant ?? '';
            $this->dateNaissanceEnfant = $this->volet->date_naissance ?? '';
            $this->lieuNaissanceEnfant = $this->volet->hopital->nom_hopital ?? '';
            $this->heureNaissance = $this->volet->heure_naissance ?? '';
            $this->sexeEnfant = $this->volet->sexe ?? '';
            $this->prenomPere = $this->volet->prenom_pere ?? '';
            $this->nomPere = $this->volet->nom_pere ?? '';
            $this->professionPere = $this->volet->profession_pere ?? '';
            $this->domicilePere = $this->volet->domicile_pere ?? '';
            $this->prenomMere = $this->volet->prenom_mere ?? '';
            $this->nomMere = $this->volet->nom_mere ?? '';
            $this->professionMere = $this->volet->profession_mere ?? '';
            $this->domicileMere = $this->volet->domicile_mere ?? '';
        }
    }

    public function updatedNumActe()
    {
        if (!empty($this->numActe)) {
            $this->existingActe = Acte::where('num_acte', $this->numActe)->first();
            $this->acteExists = $this->existingActe !== null;
        } else {
            $this->acteExists = false;
            $this->existingActe = null;
        }
    }

    public function createCopie()
    {
        // Validation
        $this->validate([
            'numActe' => 'required|string|max:255',
            'prenomEnfant' => 'required|string|max:255',
            'nomEnfant' => 'required|string|max:255',
            'dateNaissanceEnfant' => 'required|date',
            'lieuNaissanceEnfant' => 'required|string|max:255',
            'heureNaissance' => 'nullable|string|max:20',
            'sexeEnfant' => 'required|in:M,F',
            'prenomPere' => 'required|string|max:255',
            'nomPere' => 'required|string|max:255',
            'professionPere' => 'nullable|string|max:255',
            'domicilePere' => 'nullable|string|max:255',
            'prenomMere' => 'required|string|max:255',
            'nomMere' => 'required|string|max:255',
            'professionMere' => 'nullable|string|max:255',
            'domicileMere' => 'nullable|string|max:255',
            'idOfficier' => 'required|exists:officier_etat_civil,id',
            'idCommune' => 'required|exists:communes,id',
        ]);

        // Vérifier si l'acte existe déjà
        if ($this->acteExists) {
            // Vérifier si c'est une copie existante
            if ($this->existingActe->type === 'copie') {
                // Si c'est une copie existante, rediriger vers cette copie
                $this->demande->statut = 'Traitée';
                $this->demande->acte_id = $this->existingActe->id; // Lier à la copie existante
                $this->demande->save();

                Log::create([
                    'id_utilisateur' => Auth::id(),
                    'action' => 'Redirection vers copie existante',
                    'details' => 'Demande ID ' . $this->demande->id . ' redirigée vers la copie existante N°' . $this->numActe . ' (ID: ' . $this->existingActe->id . ')',
                ]);

                return redirect()->route('agent.dashboard')->with('info', 'Une copie avec le numéro ' . $this->numActe . ' existe déjà. La demande a été liée à cette copie existante. Vous pouvez la consulter dans la liste des copies.');
            } else {
                // Si c'est un acte original, créer une copie virtuelle (sans l'enregistrer)
                $this->demande->statut = 'Traitée';
                $this->demande->save();

                Log::create([
                    'id_utilisateur' => Auth::id(),
                    'action' => 'Création copie virtuelle - Acte original existant',
                    'details' => 'Copie virtuelle créée pour l\'acte original N°' . $this->numActe . ' (demande ID ' . $this->demande->id . ') - Copie non enregistrée en base car acte original existe déjà.',
                ]);

                return redirect()->route('agent.dashboard')->with('success', 'Copie créée avec succès ! L\'acte original N°' . $this->numActe . ' existe déjà dans notre base. La copie a été générée virtuellement et la demande est traitée.');
            }
        }

        // Vérifier si une copie a déjà été générée pour cette demande
        if ($this->demande->statut === 'Traitée' || $this->demande->acte_id !== null) {
            return back()->withErrors(['general' => 'Cette demande a déjà été traitée et une copie a été générée.']);
        }

        // Créer la copie
        $copie = new Acte();
        $copie->num_acte = $this->numActe;
        $copie->type = 'copie';
        $copie->prenom = $this->prenomEnfant;
        $copie->nom = $this->nomEnfant;
        $copie->date_naissance_enfant = $this->dateNaissanceEnfant;
        $copie->lieu_naissance_enfant = $this->lieuNaissanceEnfant;
        $copie->heure_naissance = $this->heureNaissance;
        $copie->sexe_enfant = $this->sexeEnfant;
        $copie->prenom_pere = $this->prenomPere;
        $copie->nom_pere = $this->nomPere;
        $copie->profession_pere = $this->professionPere;
        $copie->domicile_pere = $this->domicilePere;
        $copie->prenom_mere = $this->prenomMere;
        $copie->nom_mere = $this->nomMere;
        $copie->profession_mere = $this->professionMere;
        $copie->domicile_mere = $this->domicileMere;
        $copie->id_demande = $this->demande->id;
        $copie->id_officier = $this->idOfficier;
        $copie->id_commune = $this->idCommune;
        $copie->date_enregistrement_acte = now();
        $copie->statut = 'Traité';
        $copie->sequential_num = 0;
        
        // Génération d'un token unique pour la vérification QR code
        $copie->token = \Illuminate\Support\Str::random(32);

        $copie->save();

        // Mettre à jour le statut de la demande
        $this->demande->statut = 'Traitée';
        $this->demande->acte_id = $copie->id;
        $this->demande->save();

        // Enregistrer l'action dans les logs
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Création d\'une copie d\'acte (traitement de demande publique)',
            'details' => 'Copie d\'acte (N°' . $copie->num_acte . ') créée pour la demande ID ' . $this->demande->id . '. Acte créé ID: ' . $copie->id,
        ]);

        return redirect()->route('agent.dashboard')->with('success', 'Copie d\'acte créée avec succès et demande marquée comme traitée.');
    }

    public function render()
    {
        return view('livewire.create-copie-acte')
            ->layout('layouts.app');
    }
}
