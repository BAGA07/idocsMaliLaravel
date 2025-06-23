<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\Hopital\NaissanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoletDeclarationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PresentationController; // Assurez-vous que le chemin est correct






// =========================================================
// ROUTES POUR LES PAGES PRINCIPALES DE PRÉSENTATION
// =========================================================


// Routes pour la présentation (déjà existantes ou que vous avez)
Route::get('/', [PresentationController::class, 'index'])->name('presentation.index');
Route::get('/la-demarche', [PresentationController::class, 'laDemarche'])->name('presentation.la_demarche');
Route::get('/demander-un-acte', [PresentationController::class, 'demanderActe'])->name('presentation.demander_acte');

// Nouvelle route pour "Suivre ma Demande"
Route::get('/suivre-demande', [PresentationController::class, 'suivreDemande'])->name('presentation.suivre_demande');

// Nouvelle route pour "FAQ"
Route::get('/faq', [PresentationController::class, 'faq'])->name('presentation.faq');

// Nouvelle route pour "Contact"
Route::get('/contact', [PresentationController::class, 'contact'])->name('presentation.contact');
// Page "À Propos" principale (le fichier a_propos.blade.php)
// Cette route pointera vers le fichier a_propos.blade.php directement dans 'presentation/'
Route::get('/a-propos', [PresentationController::class, 'aProposPrincipal'])->name('presentation.a_propos_main');

// Routes pour "À Propos" (si elles n'existent pas déjà)
Route::prefix('a-propos')->name('presentation.a_propos.')->group(function () {
    Route::get('/notre-vision', [PresentationController::class, 'notreVision'])->name('notre_vision');
    Route::get('/securite-confidentialite', [PresentationController::class, 'securiteConfidentialite'])->name('securite_confidentialite');
    Route::get('/partenaires', [PresentationController::class, 'partenaires'])->name('partenaires');
});

// Route pour soumettre le formulaire de contact (méthode POST)
Route::post('/contact', [PresentationController::class, 'submitContactForm'])->name('presentation.contact.submit');

// Route pour chercher le statut de la demande (méthode POST ou GET, Livewire gérera cela)
Route::match(['get', 'post'], '/suivre-demande-status', [PresentationController::class, 'getDemandeStatus'])->name('presentation.suivre_demande.status');

// =========================================================
// ROUTES POUR LES FORMULAIRES DE DEMANDE D'ACTES (DemandeController)
// Ces routes remplacent l'ancienne route '/presentation/demande'
// =========================================================

// Route vers la page de choix du type de demande (nouveau-né ou copie extrait)
// C'est la page avec les deux boutons.
Route::get('/presentation/choix-type', [DemandeController::class, 'choixType'])->name('demande.choix_type');

// Routes pour la demande d'acte de naissance pour un nouveau-né déjà déclaré
Route::get('/presentation/nouveau-ne', [DemandeController::class, 'createNouveauNeForm'])->name('demande.nouveau_ne.create');
Route::post('/presenttation/nouveau-ne', [DemandeController::class, 'storeNouveauNe'])->name('demande.nouveau_ne.store');

// Routes pour la demande de copie d'extrait d'acte (pour actes existants)
Route::get('/presentation/copie-extrait', [DemandeController::class, 'createCopieExtraitForm'])->name('demande.copie_extrait.create');
Route::post('/presentation/copie-extrait', [DemandeController::class, 'storeCopieExtrait'])->name('demande.copie_extrait.store');

// L'ancienne route pour la demande générique  :
// Route::get('/presentation/demande', [DemandeController::class, 'create'])->name('demande.create');
// Route::post('/presentation/demande', [DemandeController::class, 'store'])->name('demande.store');
// Les routes pour le centre d'etat civil
Route::middleware([
    \App\Http\Middleware\RoleMiddleware::class . ':agent_etat_civil',
])->prefix('mairie')->group(function () {
    Route::get('/etat-civil', function () {
        return view('centre_etat_civil.index');
    })->name('etat_civil.index');

    Route::get('/etat-civil/acte-naissance', function () {
        return view('etat_civil.acte_naissance');
    })->name('etat_civil.acte_naissance');

    Route::get('/etat-civil/acte-mariage', function () {
        return view('etat_civil.acte_mariage');
    })->name('etat_civil.acte_mariage');

    Route::get('/etat-civil/acte-deces', function () {
        return view('etat_civil.acte_deces');
    })->name('etat_civil.acte_deces');
});
// fin des routes pour le centre d'etat civil

// Les routes pour le citoyen


// fin des routes pour le citoyen

// les routes pour les agents de l'hopital
Route::middleware([
    \App\Http\Middleware\RoleMiddleware::class . ':agent_hopital',
])->prefix('hopital')->group(function () {
    Route::get('/dashboard', [NaissanceController::class, 'dashboard'])->name('hopital.dashboard');
    //Route::get('/naissance', [NaissanceController::class, 'index'])->name('hopital.naissance.list');
    //Route::get('/naissance/create', [NaissanceController::class, 'create'])->name('hopital.naissance.create');
    // Route::post('/naissances', [NaissanceController::class, 'store'])->name('hopital.naissance.store');
    //Route::get('/naissance/{id}', [NaissanceController::class, 'show'])->name('hopital.naissance.show');
    Route::get('naissance/create', [VoletDeclarationController::class, 'create'])->name('naissance.create');
    Route::post('hopital/naissance', [VoletDeclarationController::class, 'store'])->name('naissance.store');
});
// fin des routes pour les agents de l'hopital




//route pour la gestion de profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
