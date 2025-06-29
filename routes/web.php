<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk halaman utama
Route::get('/', function () {
    return view('home');
})->name('home');

// Route untuk layanan
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

// Route untuk produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Route untuk tentang kami
Route::get('/about', function () {
    return view('about');
})->name('about');

// Route untuk kontak
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Route untuk user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Route untuk dashboard (admin) dan profile (user biasa)
    Route::get('/dashboard', function () {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect('/admin');
        }
        return redirect()->route('home');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Import route autentikasi
require __DIR__.'/auth.php';