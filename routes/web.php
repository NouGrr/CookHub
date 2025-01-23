<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Route pour afficher le formulaire d'inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Route pour enregistrer l'utilisateur
Route::post('/register', [AuthController::class, 'register']);

// Route pour afficher le formulaire de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route pour authentifier l'utilisateur
Route::post('/login', [AuthController::class, 'login']);

// Route pour la déconnexion de l'utilisateur
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('recettes', RecetteController::class);

// Page d'accueil
Route::get('/home', function () {
    return view('home');
})->name('home');

// Page d'accueil des recettes (liste des recettes)
Route::get('/recettes', [RecetteController::class, 'index'])->name('recette.index');

// Afficher une recette spécifique
Route::get('recettes/show', [RecetteController::class, 'show'])->name('recettes.show');

// Créer une nouvelle recette (formulaire)
Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recette.create');

// Enregistrer une nouvelle recette dans la base de données
Route::post('/recettes', [RecetteController::class, 'store'])->name('recette.store');

// Modifier une recette existante (formulaire)
Route::get('/recettes/{id}/edit', [RecetteController::class, 'edit'])->name('recette.edit');

// Mettre à jour une recette existante
Route::put('/recettes/{id}', [RecetteController::class, 'update'])->name('recette.update');

// Supprimer une recette
Route::delete('/recettes/{id}', [RecetteController::class, 'destroy'])->name('recette.destroy');

// Protéger certaines routes avec un middleware (authentification)
Route::middleware(['auth'])->group(function () {
    // Routes de gestion des recettes accessibles uniquement aux utilisateurs connectés
    Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recette.create');
    Route::post('/recettes', [RecetteController::class, 'store'])->name('recette.store');
    Route::get('/recettes/{id}/edit', [RecetteController::class, 'edit'])->name('recette.edit');
    Route::put('/recettes/{id}', [RecetteController::class, 'update'])->name('recette.update');
    Route::delete('/recettes/{id}', [RecetteController::class, 'destroy'])->name('recette.destroy');
});

// Test de stockage
Route::get('/test-storage', [RecetteController::class, 'testStorage']);
