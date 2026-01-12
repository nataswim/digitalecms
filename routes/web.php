<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\FichesCategoryController;
use App\Http\Controllers\FichesSousCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicFicheController;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
| Accessibles à tous les visiteurs (non authentifiés)
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
// Fiches publiques
Route::prefix('fiches')->name('public.fiches.')->group(function () {
    Route::get('/', [PublicFicheController::class, 'index'])->name('index');
    Route::get('/{category:slug}', [PublicFicheController::class, 'category'])->name('category');
    Route::get('/{category:slug}/{sousCategory:slug}', [PublicFicheController::class, 'sousCategory'])->name('sous-category');
    Route::get('/{category:slug}/fiche/{fiche:slug}', [PublicFicheController::class, 'show'])->name('show');
});


/*
|--------------------------------------------------------------------------
| Routes Authentification
|--------------------------------------------------------------------------
| Ces routes sont gérées par Laravel Breeze/Fortify
| (login, register, logout, forgot-password, etc.)
| Déclarées à la fin du fichier : require __DIR__.'/auth.php'
*/

/*
|--------------------------------------------------------------------------
| Routes Utilisateur Authentifié
|--------------------------------------------------------------------------
| Middleware: auth
*/

Route::middleware('auth')->group(function () {
    // Dashboard utilisateur
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

});

/*
|--------------------------------------------------------------------------
| Routes Administration
|--------------------------------------------------------------------------
| Préfixe: /admin
| Middleware: auth (+ permission selon la route)
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard admin (accessible à tous les utilisateurs authentifiés)
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    
    // Profil admin
    Route::get('/profile', [ProfileController::class, 'adminShow'])->name('profile.show');
    
    /*
    |--------------------------------------------------------------------------
    | Gestion des Utilisateurs
    |--------------------------------------------------------------------------
    | ORDRE IMPORTANT : routes spécifiques (create, edit) AVANT les routes paramétrées ({user})
    */
    
    // Créer un utilisateur
    Route::middleware('permission:users.create')->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });
    
    // Modifier un utilisateur
    Route::middleware('permission:users.edit')->group(function () {
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}', [UserController::class, 'update']);
    });
    
    // Voir les utilisateurs
    Route::middleware('permission:users.view')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    });
    
    // Supprimer un utilisateur
    Route::middleware('permission:users.delete')->group(function () {
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Gestion des Rôles
    |--------------------------------------------------------------------------
    */
    
    Route::middleware('permission:roles.manage')->group(function () {
        Route::resource('roles', RoleController::class);
    });
    
    /*
    |--------------------------------------------------------------------------
    | Gestion des Permissions
    |--------------------------------------------------------------------------
    */
    
    Route::middleware('permission:permissions.manage')->group(function () {
        Route::resource('permissions', PermissionController::class);
    });
    
    /*
    |--------------------------------------------------------------------------
    | Gestion des Médias
    |--------------------------------------------------------------------------
    | ORDRE IMPORTANT : routes spécifiques AVANT resource
    */
    
    Route::middleware('permission:media.manage')->group(function () {
        // Catégories de médias
        Route::get('/media/categories', [MediaController::class, 'categories'])->name('media.categories');
        Route::post('/media/categories', [MediaController::class, 'storeCategory'])->name('media.categories.store');
        Route::delete('/media/categories/{category}', [MediaController::class, 'destroyCategory'])->name('media.categories.destroy');
        
        // Actions en masse
        Route::post('/media/bulk-action', [MediaController::class, 'bulkAction'])->name('media.bulk-action');
        
        // CRUD médias - ORDRE IMPORTANT : create AVANT {media}
        Route::get('/media/create', [MediaController::class, 'create'])->name('media.create');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
        Route::get('/media/{media}/edit', [MediaController::class, 'edit'])->name('media.edit');
        Route::put('/media/{media}', [MediaController::class, 'update'])->name('media.update');
        Route::patch('/media/{media}', [MediaController::class, 'update']);
        Route::get('/media/{media}', [MediaController::class, 'show'])->name('media.show');
        Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Gestion des Fiches
    |--------------------------------------------------------------------------
    | ORDRE IMPORTANT : API et actions spéciales AVANT CRUD
    */
    
    // API pour sous-catégories dynamiques (accessible avec fiches.manage)
    Route::middleware('permission:fiches.manage')->group(function () {
        Route::get('/api/fiches-sous-categories/by-category', [FichesSousCategoryController::class, 'apiByCategory'])
            ->name('api.fiches-sous-categories.by-category');
    });
    
    // Catégories de fiches
    Route::middleware('permission:fiches.manage')->group(function () {
        Route::resource('fiches-categories', FichesCategoryController::class);
    });
    
    // Sous-catégories de fiches
    Route::middleware('permission:fiches.manage')->group(function () {
        Route::resource('fiches-sous-categories', FichesSousCategoryController::class);
    });
    
    // Fiches - ORDRE IMPORTANT : actions en masse AVANT CRUD
    Route::middleware('permission:fiches.manage')->group(function () {
        // Actions en masse
        Route::post('/fiches/bulk-assign-categories', [FicheController::class, 'bulkAssignCategories'])
            ->name('fiches.bulk-assign-categories');
        
        // CRUD fiches
        Route::get('/fiches/create', [FicheController::class, 'create'])->name('fiches.create');
        Route::post('/fiches', [FicheController::class, 'store'])->name('fiches.store');
        Route::get('/fiches/{fiche}/edit', [FicheController::class, 'edit'])->name('fiches.edit');
        Route::put('/fiches/{fiche}', [FicheController::class, 'update'])->name('fiches.update');
        Route::patch('/fiches/{fiche}', [FicheController::class, 'update']);
        Route::get('/fiches/{fiche}', [FicheController::class, 'show'])->name('fiches.show');
        Route::delete('/fiches/{fiche}', [FicheController::class, 'destroy'])->name('fiches.destroy');
        Route::get('/fiches', [FicheController::class, 'index'])->name('fiches.index');
    });
});

/*
|--------------------------------------------------------------------------
| Routes d'Authentification Laravel
|--------------------------------------------------------------------------
| Gérées par Laravel Breeze/Fortify
| Contient : login, register, logout, forgot-password, reset-password, verify-email, etc.
*/

require __DIR__.'/auth.php';