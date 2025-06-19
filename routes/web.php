<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\Hopital\NaissanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoletDeclarationController;
use Illuminate\Support\Facades\Route;

// les routes pour la page de presentation
Route::get('/', function () {
    return view('presentation.index');
})->name('presentation.index');

Route::get('/solution', function () {
    return view('presentation.solution');
})->name('presentation.solution');

Route::get('/service', function () {
    return view('presentation.service');
})->name('presentation.service');

Route::get('/about', function () {
    return view('presentation.about');
})->name('presentation.about');
// fin des routes pour la page de presentation


// Les routes pour le centre d'etat civil
Route::middleware([
    'role:agent_etat_civil',
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

//route pour les demande
Route::get('/demande/choix', [DemandeController::class, 'choix'])->name('demande.choix');

Route::get('/demande/nouveau-ne', [DemandeController::class, 'create'])->name('demande.create');
Route::post('/demande/nouveau-ne', [DemandeController::class, 'storeNouveauNe'])->name('demande.nouveau_ne.store');
Route::post('/citoyen/demande', [DemandeController::class, 'store'])->name('demande.store');

Route::get('/demande/sans-info', [DemandeController::class, 'sansInfo'])->name('demande.sans_info');
Route::get('/demande/copie', [DemandeController::class, 'copie'])->name('demande.copie');
// fin des route pour le demande

// les routes pour les agents de l'hopital
Route::middleware([
    'role:agent_hopital',
])->prefix('hopital')->group(function () {
    Route::get('/dashboard', [NaissanceController::class, 'dashboard'])->name('hopital.dashboard');
    Route::get('/naissances/{id}', [NaissanceController::class, 'show'])->name('hopital.naissance.show');
    Route::get('naissance/create', [VoletDeclarationController::class, 'create'])->name('naissance.create');
    Route::post('hopital/naissance', [VoletDeclarationController::class, 'store'])->name('naissance.store');
    Route::get('/naissance/{id}/edit', [VoletDeclarationController::class, 'edit'])->name('naissance.edit');
});
// fin des routes pour les agents de l'hopital

//route pour la gestion de profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';