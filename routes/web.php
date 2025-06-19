<?php

use App\Http\Controllers\Hopital\NaissanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;





// =========================================================
// ROUTES POUR LES PAGES PRINCIPALES DE PRÉSENTATION
// =========================================================

// Page d'Accueil
Route::get('/', function () {
    return view('presentation.index');
})->name('presentation.index');

// Page "Demander un Acte" (le formulaire)
Route::get('/demander-un-acte', function () {
    return view('presentation.demander_acte');
})->name('presentation.demander_acte');

// NOUVELLE ROUTE ICI POUR LA DÉMARCHE DE DEMANDE
Route::get('/la-demarche', function () {
    return view('presentation.la-demarche'); // Chemin de la vue : resources/views/presentation/la_demarche.blade.php
})->name('presentation.la_demarche');

// Page "Suivre ma Demande"
Route::get('/suivre-ma-demande', function () {
    return view('presentation.suivre_demande');
})->name('presentation.suivre_demande');

// Page "Le Projet / À Propos" (page principale de cette section)
Route::get('/a-propos', function () {
    return view('presentation.a_propos');
})->name('presentation.a_propos');


// =========================================================
// ROUTES POUR LE DROPDOWN "LE PROJET / À PROPOS" (Sous-pages)
// =========================================================

Route::prefix('a-propos')->name('presentation.a_propos.')->group(function () {
    Route::get('/notre-vision', function () {
        return view('presentation.a_propos.notre_vision');
    })->name('notre_vision');

    Route::get('/securite-confidentialite', function () {
        return view('presentation.a_propos.securite-confidentialite');
    })->name('securite_confidentialite');

    Route::get('/partenaires', function () {
        return view('presentation.a_propos.partenaires');
    })->name('partenaires');
});

// =========================================================
// AUTRES ROUTES DU MENU PRINCIPAL
// =========================================================

// Page FAQ
Route::get('/faq', function () {
    return view('presentation.faq');
})->name('presentation.faq');

// Page Contact
Route::get('/contact', function () {
    return view('presentation.contact');
})->name('presentation.contact');
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



Route::get('/form', function () {
    return view('citoyen.form_demande');
})->name('form');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//route pour la gestion de profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
