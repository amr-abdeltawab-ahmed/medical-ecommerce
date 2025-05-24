<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Guest/Customer Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Routes
Route::get('/products', [HomeController::class, 'index'])->name('products');
Route::get('/products/{product}', [HomeController::class, 'show'])->name('products.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.submit');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('confirmation');

// Dashboard & Profile Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        if (Auth::user()->email === 'admin@example.com') {
            return view('dashboard');
        }
        return redirect()->route('home');
    })->middleware('verified')->name('dashboard');

    // Profile
    Route::redirect('/profile', '/profile')->name('profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
});

// Authentication Routes
require __DIR__.'/auth.php';
