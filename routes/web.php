<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/* 
Route::get('/', function () {
    return view('welcome');
}); */
// les routes pour le ladding page
Route::get('/', function () {
    return view('presentation.index');
})->name('presentation.index');


// Les routes pour le centre d'etat civil
Route::middleware('auth')->group(function () {
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
    return view('citoyen.index');
})->name('citoyen.index');


// les routes pour les agents de l'hopital
Route::get('/hopital', function () {
    return view('hopital.index');
})->name('hopital.index');



Route::get('/form', function () {
    return view('citoyen.form_demande');
})->name('form');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

Route::get('/inscription-reussie', function () {
    return view('auth.inscription_reussie');
})->name('inscription.reussie');
