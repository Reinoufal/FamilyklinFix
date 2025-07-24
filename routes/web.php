<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk halaman utama
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route untuk layanan
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', function ($slug) {
    if ($slug === 'hydrovaccum') {
        return view('services.hydrovaccum');
    } elseif ($slug === 'cuci-bersih') {
        return view('services.cuci-bersih');
    } else {
        abort(404);
    }
})->name('services.show');

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
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'count'])->name('cart.count');
Route::get('/checkout', [App\Http\Controllers\CartController::class, 'showCheckoutForm'])->name('checkout.form');
Route::get('/checkout/success/{order}', function($orderId) {
    $order = \App\Models\Order::findOrFail($orderId);
    return view('cart.success', compact('order'));
})->name('checkout.success');

Route::get('/cart/mini', [App\Http\Controllers\CartController::class, 'mini'])->name('cart.mini');

Route::get('/order/verify/{order}', function($orderId) {
    $order = \App\Models\Order::findOrFail($orderId);
    return view('order.verify', compact('order'));
})->name('order.verify');

Route::get('/order/{order}/detail', [App\Http\Controllers\OrderController::class, 'detail'])->name('order.detail');
Route::get('/order/{order}/invoice', [App\Http\Controllers\OrderController::class, 'invoice'])->name('order.invoice');

// Import route autentikasi
require __DIR__.'/auth.php';