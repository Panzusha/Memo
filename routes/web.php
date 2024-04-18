<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Models\Note;
use Illuminate\Support\Facades\Route;

// le nom des 2e paramètres de tableau est celui des fonctions dans les controllers correspondants

// middleware guest pour les droits d'accès aux pages d'inscription/connexion (statut guest)
Route::middleware('guest')->group(function () {

});

// middleware pour droit d'accès au compte utilisateur (statut auth)
Route::middleware('auth')->group(function () {

});

// middleware pour droit d'accès admin
Route::middleware('admin')->group(function () {

});

// routes sans middlewares
// route index, le premier 'index' est le nom de la fonction dans NoteController.php
Route::get('/', [NoteController::class, 'index'])->name('index');


