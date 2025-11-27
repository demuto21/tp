<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Authentification\AuthController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminClient;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// Routes publiques
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/produit/{id}', [ProductController::class, 'show'])->name('produit.show');
Route::get('/produit', [ProductController::class, 'index'])->name('produit.index');


// Auth
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/produits', [AdminProductController::class, 'index'])->name('produits.index');
    Route::get('/produits/ajouter', [AdminProductController::class, 'create'])->name('produits.create');
    Route::post('/produits', [AdminProductController::class, 'store'])->name('produits.store');
    Route::get('/produits/{id}/modifier', [AdminProductController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{id}', [AdminProductController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{id}', [AdminProductController::class, 'destroy'])->name('produits.destroy');
    Route::patch('/produits/{id}/categorie', [AdminProductController::class, 'updateCategory'])->name('produits.updateCategory');

    Route::get('/clients', [AdminClient::class, 'index'])->name('clients.index');
    Route::get('/commandes', [AdminOrderController::class, 'index'])->name('commandes.index');
    Route::patch('/commandes/{id}/statut', [AdminOrderController::class, 'updateStatus'])->name('commandes.updateStatus');

    Route::get('/clients', [AdminClient::class, 'index'])->name('clients.index');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    
    Route::resource('produits', AdminProductController::class); 
Route::get('produits/create', [AdminProductController::class, 'create'])->name('produits.create');
});
});
