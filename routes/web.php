<?php

use App\Http\Controllers\Hopital\NaissanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;


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


// Les routes pour le citoyen
Route::get('/citoyen', function () {
    return view('citoyen.form_demande');
})->name('citoyen.index');


// les routes pour les agents de l'hopital
Route::middleware([
    \App\Http\Middleware\RoleMiddleware::class . ':agent_hopital',
])->prefix('hopital')->group(function () {
    Route::get('/dashboard', [NaissanceController::class, 'dashboard'])->name('hopital.dashboard');
    Route::get('/naissance', [NaissanceController::class, 'index'])->name('hopital.naissance.list');
    Route::get('/naissance/create', [NaissanceController::class, 'create'])->name('hopital.naissance.create');
    Route::post('/naissances', [NaissanceController::class, 'store'])->name('hopital.naissance.store');
    Route::get('/naissance/{id}', [NaissanceController::class, 'show'])->name('hopital.naissance.show');
});



/* Route::get('/form', function () {
    return view('citoyen.form_demande');
})->name('form');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */


//route pour la gestion de profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
