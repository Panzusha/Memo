<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

// le nom des 2e paramètres de tableau est celui des fonctions dans les controllers correspondants

// middleware guest pour les droits d'accès aux pages d'inscription/connexion (statut guest)
Route::middleware('guest')->group(function () {
    // route formulaire inscription
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // route inscription nouveau membre
    Route::post('/register', [RegisterController::class, 'register']);
    // route formulaire connexion
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    // route connexion membre
    Route::post('/login', [LoginController::class, 'login']);
});

// middleware pour droit d'accès au compte utilisateur (statut auth)
Route::middleware('auth')->group(function () {
    // route compte utilisateur (home est une valeur laravel par défaut)
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // route déconnexion
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// middleware pour droit d'accès admin
Route::middleware('admin')->group(function () {

});

// routes sans middlewares

// route index, le premier 'index' est le nom de la fonction dans NoteController.php
Route::get('/', [NoteController::class, 'index'])->name('index');
// route pour affichage individuel d'une note
    // route model binding : {note} correspond a $note dans la fonction show de NoteController.php
Route::get('/{note}', [NoteController::class, 'show'])->name('notes.show');
// route pour le filtrage des posts par categories
Route::get('/categories/{category}', [NoteController::class, 'notesByCategory'])->name('notes.byCategory');
// route pour le filtrage des posts par tags
Route::get('/tags/{tag}', [NoteController::class, 'notesByTag'])->name('notes.byTag');
