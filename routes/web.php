<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AtelierController;
use Illuminate\Support\Str;

// Routes d'authentification
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes de gestion des recettes
Route::resource('recettes', RecetteController::class);

// Page d'accueil
Route::get('/home', function () {
    return view('home');
})->name('home');

// Page d'accueil des recettes (liste des recettes)
Route::get('/recettes', [RecetteController::class, 'index'])->name('recette.index');

// Afficher une recette spécifique
Route::get('recettes/{id}', [RecetteController::class, 'show'])->name('recettes.show');

// Créer une nouvelle recette (formulaire)
Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recette.create');

// Enregistrer une nouvelle recette dans la base de données
Route::post('/recettes', [RecetteController::class, 'store'])->name('recette.store');

// Modifier une recette existante (formulaire)
Route::get('/recettes/{user_id}/edit', [RecetteController::class, 'edit'])->name('recette.edit');

// Mettre à jour une recette existante
Route::put('/recettes/{user_id}', [RecetteController::class, 'update'])->name('recette.update');

// Protéger certaines routes avec un middleware (authentification)
Route::middleware(['auth'])->group(function () {
    // Routes de gestion des recettes accessibles uniquement aux utilisateurs connectés
    Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recette.create');
    Route::post('/recettes', [RecetteController::class, 'store'])->name('recette.store');
    Route::get('/recettes/{user_id}/edit', [RecetteController::class, 'edit'])->name('recette.edit');
    Route::put('/recettes/{user_id}', [RecetteController::class, 'update'])->name('recette.update');
    Route::delete('/recettes/{user_id}', [RecetteController::class, 'destroy'])->name('recettes.destroy');

    // Routes de gestion des ateliers accessibles uniquement aux utilisateurs connectés
    Route::resource('ateliers', AtelierController::class);
    Route::post('ateliers/{id}/add-participant', [AtelierController::class, 'addParticipant'])->name('ateliers.addParticipant');
});

// Test de stockage
Route::get('/test-storage', [RecetteController::class, 'testStorage']);

Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// Middleware 'admin' pour protéger les actions réservées aux administrateurs
Route::middleware(['auth', 'admin'])->group(function () {
    Route::delete('/recettes/{user_id}', [RecetteController::class, 'destroy'])->name('recettes.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('ateliers', AtelierController::class);
    
    // Route pour supprimer un atelier
    Route::delete('/ateliers/{user_id}', [AtelierController::class, 'destroy'])->name('ateliers.destroy');
    // Afficher le formulaire de création d'un atelier
    Route::get('/ateliers/create', [AtelierController::class, 'create'])->name('ateliers.create');

    // Enregistrer un atelier dans la base de données
    Route::post('/ateliers', [AtelierController::class, 'store'])->name('ateliers.store');

});