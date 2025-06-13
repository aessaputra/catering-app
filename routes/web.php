<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// == Admin Controller ==
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

// == Public Controller ==
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kita mendaftarkan semua rute untuk aplikasi kita.
|
*/

// == RUTE PUBLIK ==
// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
// Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
// Route::post('/process-order', [OrderController::class, 'processWhatsAppOrder'])->name('order.process');
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


// == RUTE ADMIN ==
// Grup rute ini hanya bisa diakses oleh user yang sudah login (auth)
// dan URL-nya diawali dengan /admin.
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    
    // Rute Profile (edit, update, delete) bawaan Breeze, kita letakkan juga di dalam grup admin.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rute CRUD untuk Kategori
    // Ini akan secara otomatis membuat rute:
    // admin.categories.index, .create, .store, .show, .edit, .update, .destroy
    Route::resource('categories', CategoryController::class);
    
    // Rute CRUD untuk Produk
    // Route::resource('products', ProductController::class);
});