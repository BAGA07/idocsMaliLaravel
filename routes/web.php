<?php

use App\Http\Controllers\Acte_naissance;
use App\Http\Controllers\Admin\AdminManagerController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\Hopital\NaissanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoletDeclarationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PaiementController;

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

Route::get('/nouveau-ne', [PresentationController::class, 'nouveauNeGuide'])->name('demande.nouveau_ne.guide');
Route::get('/copie-extrait', [PresentationController::class, 'copieExtraitGuide'])->name('demande.copie_extrait.guide');
Route::get('/jugement-suppletif', [PresentationController::class, 'jugementSuppletifGuide'])->name('demande.jugement_suppletif.guide');

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

// Les routes pour le centre d'etat civil

//Route pour agent de la mairie
Route::middleware([
    'role:agent_mairie',
])->prefix('mairie')->group(function () {
    Route::get('agent', [Acte_naissance::class, 'index'])->name('agent.dashboard');
    Route::get('/acte/create/{id}', [Acte_naissance::class, 'create'])->name('acte.create');
    Route::post('/acte', [Acte_naissance::class, 'store'])->name('acte.store');
    Route::get('/actes/{id}', [Acte_naissance::class, 'show'])->name('acte.show');
    Route::get('/actes/{id}/edit', [Acte_naissance::class, 'edit'])->name('acte.edit');
    Route::put('/actes/{id}', [Acte_naissance::class, 'update'])->name('acte.update');
    Route::delete('/actes/{id}', [Acte_naissance::class, 'destroy'])->name('acte.destroy');
    // Route::get('/acteCopies/create/{id}', [Acte_naissance::class, 'creates'])->name('acteCopies.create');
    Route::get('/acteCopies/create/{id}', [Acte_naissance::class, 'creates'])->name('acteCopies.create');
    Route::post('/acteCopies/store', [Acte_naissance::class, 'stores'])->name('acteCopies.store');
        Route::get('/demandesTraiter', [Acte_naissance::class, 'listTraiter'])->name('listTraiter');
        Route::get('/demandesEnattente', [Acte_naissance::class, 'listEnattente'])->name('listEnattente');
        Route::get('/demandesRejeté', [Acte_naissance::class, 'listRejeté'])->name('listRejeté');
        Route::get('/Naissances/volet', [Acte_naissance::class, 'listNaissancesVolet'])->name('volet');
        Route::get('/Naissances/copie', [Acte_naissance::class, 'listNaissancesCopie'])->name('copie');


    
});
// fin des routes pour le centre d'etat civil


// les routes pour les agents de l'hopital
Route::middleware([
    'role:agent_hopital',
])->prefix('hopital')->group(function () {
    Route::get('/dashboard', [VoletDeclarationController::class, 'dashboard'])->name('hopital.dashboard');
    Route::resource('naissances', VoletDeclarationController::class);
});
// fin des routes pour les agents de l'hopital

//route pour la gestion de profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route pour l'administration des managers
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/managers/structureList', [AdminManagerController::class, 'structureList'])->name('structure.list');
    Route::resource('/managers', AdminManagerController::class);
});

Route::post('/declaration/send-notification/{id}', [App\Http\Controllers\DeclarationController::class, 'sendNotification'])->name('declaration.sendNotification');

Route::post('/payer', [App\Http\Controllers\PaiementController::class, 'payer'])->name('payer');
Route::get('/paiement/confirmation', [PaiementController::class, 'confirmation'])->name('paiement.confirmation');


//Route::get('/dashboard-agent', [Acte_naissance::class, 'index'])->name('agent_mairie.dasboard');


require __DIR__ . '/auth.php';
