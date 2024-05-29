<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::resource('articles', ArticleController::class);
    // Route pour la liste des catégories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    // Route pour afficher le formulaire de création de catégorie
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    // Route pour enregistrer une nouvelle catégorie
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

    // Route pour afficher le formulaire de modification de catégorie
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    // Route pour mettre à jour une catégorie
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    // Route pour supprimer une catégorie
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    // Autres routes...
});



Route::get('/dashboard', function () {
    return redirect()->route('articles.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
