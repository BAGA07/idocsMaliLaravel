<?php

use App\Http\Controllers\Acte_naissance;
use App\Http\Controllers\Admin\AdminManagerController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoletDeclarationController;
use App\Http\Controllers\OfficierActeController;
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
Route::post('/presentation/nouveau-ne', [DemandeController::class, 'storeNouveauNe'])->name('demande.nouveau_ne.store');

// Routes pour la demande de copie d'extrait d'acte (pour actes existants)
Route::get('/presentation/copie-extrait', [DemandeController::class, 'createCopieExtraitFormPublique'])->name('demande.copie_extrait.create');
Route::post('/presentation/copie-extrait', [DemandeController::class, 'storeDemandeCopiePublique'])->name('demande.copie_extrait.store');

// Route de test pour vérifier les justificatifs (à supprimer en production)
Route::get('/test-justificatifs', [DemandeController::class, 'testJustificatifs'])->name('test.justificatifs');
Route::get('/diagnostic-justificatifs', function () {
    return view('diagnostic_justificatifs');
})->name('diagnostic.justificatifs');

// Les routes pour le centre d'etat civil

//Route pour agent de la mairie
Route::middleware([
    'role:agent_mairie',
])->prefix('mairie')->group(function () {
    Route::get('agent', [Acte_naissance::class, 'index'])->name('agent.dashboard');
    Route::get('/acte/create/{id}', [Acte_naissance::class, 'createActeOriginalForm'])->name('acte.create');
    Route::post('/acte', [Acte_naissance::class, 'store'])->name('acte.store');
    Route::get('/actes/{id}', [Acte_naissance::class, 'show'])->name('acte.show');
    Route::get('/actes/{id}/edit', [Acte_naissance::class, 'edit'])->name('acte.edit');
    Route::put('/actes/{id}', [Acte_naissance::class, 'update'])->name('acte.update');
    Route::delete('/actes/{id}', [Acte_naissance::class, 'destroy'])->name('acte.destroy');
    // Route::get('/acteCopies/create/{id}', [Acte_naissance::class, 'creates'])->name('acteCopies.create');
    Route::get('/acteCopies/create/{id}', [Acte_naissance::class, 'creates'])->name('acteCopies.create');
    Route::post('/acteCopies/store', [Acte_naissance::class, 'stores'])->name('acteCopies.store');

    /*  Route::get('/demandesTraiter', [Acte_naissance::class, 'listTraiter'])->name('listTraiter');
    Route::get('/demandesEnattente', [Acte_naissance::class, 'listEnattente'])->name('listEnattente');
    Route::get('/demandesRejeté', [Acte_naissance::class, 'listRejeté'])->name('listRejeté');
    Route::get('/notifications', [Acte_naissance::class, 'notifications'])->name('mairie.notifications.index');
======= */
    Route::post('/demandes/{id}/rejeter', [Acte_naissance::class, 'rejeterDemande'])->name('mairie.demandes.rejeter');
    Route::get('/demandesTraiter', [Acte_naissance::class, 'listTraiter'])->name('listTraiter');
    Route::get('/demandesEnattente', [Acte_naissance::class, 'listEnattente'])->name('listEnattente');
    Route::get('/demandesRejeté', [Acte_naissance::class, 'listRejeté'])->name('listRejeté');
    Route::get('/d', [Acte_naissance::class, 'listRejeté'])->name('listRejeté');

    Route::get('/notifications', [Acte_naissance::class, 'notifications'])->name('mairie.notifications.index');

    Route::get('/notifications/{id}', [Acte_naissance::class, 'showNotification'])->name('notifications.show');
    Route::post('/notifications/mark-all-read', [Acte_naissance::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::post('/notifications/{id}/mark-read', [Acte_naissance::class, 'ajaxMarkRead'])->name('notifications.markRead');




    // Routes pour le dashboard des copies/extraits
    Route::get('/dashboard/copies', [Acte_naissance::class, 'dashboardCopies'])->name('mairie.dashboard.copies');
    Route::get('/copies/{id}/show', [Acte_naissance::class, 'showCopie'])->name('copies.show');

    // Route API pour vérifier l'existence d'un acte
    Route::get('/api/check-acte-exists/{numActe}', [Acte_naissance::class, 'checkActeExists'])->name('api.check-acte-exists');

    // Route de test simple
    Route::get('/api/test', function () {
        return response()->json(['message' => 'API fonctionne']);
    });
    Route::post('/copies/{id}/envoyer-officier', [Acte_naissance::class, 'envoyerCopieOfficier'])->name('copies.envoyer_officier');

    // Routes pour le dashboard des actes de naissance
    Route::get('/dashboard/actes', [Acte_naissance::class, 'dashboardActes'])->name('mairie.dashboard.actes');
    Route::post('/actes/{id}/envoyer-officier', [Acte_naissance::class, 'envoyerActeOfficier'])->name('acte.envoyer_officier');
});
// fin des routes pour le centre d'etat civil

// Route de test en dehors du middleware pour diagnostiquer
Route::get('/debug-auth', function () {
    return response()->json([
        'user' => Auth::user(),
        'role' => Auth::user() ? Auth::user()->role : 'non connecté',
        'authenticated' => Auth::check(),
        'session' => session()->all()
    ]);
})->name('debug.auth');

// Route API de test en dehors du middleware
Route::get('/api/test-acte/{numActe}', function ($numActe) {
    try {
        $acte = \App\Models\Acte::where('num_acte', $numActe)->first();
        return response()->json([
            'exists' => $acte ? true : false,
            'acte' => $acte ? [
                'num_acte' => $acte->num_acte,
                'prenom' => $acte->prenom,
                'nom' => $acte->nom,
                'date_naissance_enfant' => $acte->date_naissance_enfant,
                'type' => $acte->type
            ] : null,
            'type' => $acte ? $acte->type : null
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->name('api.test-acte');

// Route de test pour la signature
Route::get('/test-signature', function () {
    return view('test_signature');
})->name('test.signature');

// Route pour servir les images directement
Route::get('/images/{path}', [App\Http\Controllers\ImageController::class, 'show'])
    ->where('path', '.*')
    ->name('images.show');


// les routes pour les agents de l'hopital
Route::middleware([
    'role:agent_hopital',
])->prefix('hopital')->group(function () {
    Route::get('/dashboard', [VoletDeclarationController::class, 'dashboard'])->name('hopital.dashboard');
    Route::post('/hopital/demandes/envoyer/{id_volet}', [App\Http\Controllers\Hopital\DemandeController::class, 'envoyerDemande'])->name('hopital.demandes.envoyer');
    Route::resource('naissances', VoletDeclarationController::class);
});
// fin des routes pour les agents de l'hopital

// Routes pour l'officier d'état civil
Route::middleware([
    'role:officier',
])->prefix('officier')->group(function () {
    Route::get('/dashboard', [OfficierActeController::class, 'dashboard'])->name('officier.dashboard');
    Route::get('/finaliser/{id}', [OfficierActeController::class, 'showFinalisation'])->name('officier.finaliser');
    Route::post('/finaliser/{id}', [OfficierActeController::class, 'finaliser'])->name('officier.finaliser.store');

    // Routes pour les actes (compatibilité avec les vues)
    Route::get('/actes/finaliser/{id}', [OfficierActeController::class, 'showFinalisation'])->name('officier.actes.finaliser');
    Route::post('/actes/finaliser/{id}', [OfficierActeController::class, 'finaliser'])->name('officier.actes.finaliser.post');
    Route::get('/finaliser-copie/{id}', [OfficierActeController::class, 'showFinalisationCopie'])->name('officier.finaliser.copie');
    Route::post('/finaliser-copie/{id}', [OfficierActeController::class, 'finaliserCopie'])->name('officier.finaliser.copie.store');

    // Routes supplémentaires pour compatibilité avec les vues
    Route::get('/copies/finaliser/{id}', [OfficierActeController::class, 'showFinalisationCopie'])->name('officier.copies.finaliser');
    Route::post('/copies/finaliser/{id}', [OfficierActeController::class, 'finaliserCopie'])->name('officier.copies.finaliser.post');

    Route::get('/pdf/{id}', [OfficierActeController::class, 'generatePdf'])->name('officier.pdf');
    Route::get('/pdf-copie/{id}', [OfficierActeController::class, 'generatePdfCopie'])->name('officier.pdf.copie');

    // Routes supplémentaires pour les PDFs
    Route::get('/actes/pdf/{id}', [OfficierActeController::class, 'generatePdf'])->name('officier.actes.pdf');
    Route::get('/copies/pdf/{id}', [OfficierActeController::class, 'generatePdfCopie'])->name('officier.copies.pdf');
    Route::get('/historique', [OfficierActeController::class, 'historique'])->name('officier.historique');
});
// fin des routes pour l'officier


Route::post('/declaration/send-notification/{id}', [App\Http\Controllers\DeclarationController::class, 'sendNotification'])->name('declaration.sendNotification');

Route::post('/payer', [App\Http\Controllers\PaiementController::class, 'payer'])->name('payer');
Route::get('/paiement/confirmation', [PaiementController::class, 'confirmation'])->name('paiement.confirmation');

Route::get('/verifier-document/{token}', [App\Http\Controllers\VerificationController::class, 'verifier'])->name('verifier.document');

//Route::get('/dashboard-agent', [Acte_naissance::class, 'index'])->name('agent_mairie.dasboard');

Route::get('/acte/{id}/pdf', [App\Http\Controllers\Acte_naissance::class, 'downloadPdf'])->name('acte.pdf');






//route pour la gestion de profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route pour l'administration des managers (Admin crée les managers)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/manager/dashboard', [App\Http\Controllers\Manager\DashboardController::class, 'index'])->name('managers.index');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/managers/structureList', [AdminManagerController::class, 'structureList'])->name('structure.list');

    Route::resource('managers', AdminManagerController::class);

    Route::get('/structures', [App\Http\Controllers\Admin\StructureController::class, 'index'])->name('structures.index');
});

// Routes pour les managers (Manager crée les agents)
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Manager\DashboardController::class, 'index'])->name('managers.index');

    // Gestion des agents par le manager ou admin
    Route::resource('agents', App\Http\Controllers\Manager\AgentController::class);

    // Gestion des structures par le manager ou admin
    Route::resource('structures', App\Http\Controllers\Manager\StructureController::class);
    Route::resource('officiers', App\Http\Controllers\Manager\OfficerController::class);
});
// Route pour l'envoi de la demande à la mairie depuis l'hôpital
Route::post('/hopital/demandes/envoyer/{id_volet}', [App\Http\Controllers\Hopital\DemandeController::class, 'envoyerDemande'])->name('hopital.demandes.envoyer');


require __DIR__ . '/auth.php';
