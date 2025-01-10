<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products', [ShopController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ShopController::class, 'show'])->name('products.show');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');


Route::post('/buy/{product}', [ShopController::class, 'buy'])->name('products.buy')->middleware('auth');

Route::get('/thank-you', function () {
    return view('thankyou');
})->name('thankyou');



Route::post('/cart/checkout', function () {
    dd('Route is working!');
})->name('cart.checkout');


Route::middleware('auth')->group(function () {
    Route::post('/cart/{product}', [ShopController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ShopController::class, 'viewCart'])->name('cart.index');
    Route::post('/cart/checkout', [ShopController::class, 'checkout'])->name('cart.checkout');
});

Route::middleware('auth')->post('/cart/checkout', [ShopController::class, 'checkout'])->name('cart.checkout');


Route::middleware('auth')->post('/cart/checkout', [ShopController::class, 'checkout'])->name('cart.checkout');

Route::get('/orders/{order}', [ShopController::class, 'showOrder'])->name('orders.show');


require __DIR__.'/auth.php';
