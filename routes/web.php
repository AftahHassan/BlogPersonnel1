<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// =====================
// ROUTES PUBLIQUES
// =====================

// Page d'accueil = liste des articles publiés
Route::get('/', [PublicController::class, 'index'])->name('home');

// Liste des articles publiés
Route::get('/articles', [PublicController::class, 'index'])->name('articles.index');

// Détail d'un article
Route::get('/articles/{article}', [PublicController::class, 'show'])->name('articles.show');

// =====================
// ROUTES PROTÉGÉES (auth)
// =====================

Route::middleware('auth')->group(function () {

    // Tableau de bord
    Route::get('/dashboard', [ArticleController::class, 'index'])->name('dashboard');

    // Créer un article
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    // Modifier un article
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');

    // Supprimer un article
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Profile Breeze (déjà inclus)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes Breeze (login/logout)
require __DIR__.'/auth.php';