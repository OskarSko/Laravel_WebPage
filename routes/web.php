<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::get('/products', [ShopController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ShopController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/{product}', [ShopController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ShopController::class, 'viewCart'])->name('cart.index');
    Route::delete('/cart/{cartItem}', [ShopController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/checkout', [ShopController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/checkout/process-payment', [ShopController::class, 'processPayment'])->name('cart.process.payment');
    Route::get('/cart/checkout/address-payment', [ShopController::class, 'checkoutAddressPayment'])->name('cart.checkout.address');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{order}', [ShopController::class, 'showOrder'])->name('orders.show');
    Route::get('/thank-you', function () {
        $order = session('order');
        return view('shop.checkout.thankyou', compact('order'));
    })->name('thankyou');
});

Route::post('/reviews', [ShopController::class, 'storeReview'])->name('reviews.store')->middleware('auth');


Route::post('/buy-now/{product}', [ShopController::class, 'buyNowAddressPayment'])->name('products.buy.now');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/profile/data', [ProfileController::class, 'data'])->name('profile.data');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
    Route::patch('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
});


Route::middleware(['auth', 'employee', ])->group(function () {
    Route::get('/products/create', [ShopController::class, 'create'])->name('products.create');
    Route::post('/products', [ShopController::class, 'store'])->name('products.store');
});

Route::post('/buy/{product}', [ShopController::class, 'buyNowAddressPayment'])->name('products.buy.now');

Route::post('/buy/{product}', [ShopController::class, 'buy'])->name('products.buy')->middleware('auth');
Route::get('/products', [ShopController::class, 'index'])->name('products.index');
Route::patch('/products/{product}', [ShopController::class, 'update'])->name('products.update');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::delete('/products/{id}', [ShopController::class, 'destroy'])->name('products.destroy');
});

Route::post('/toggle-contrast', [AccessibilityController::class, 'toggleContrast'])->name('toggle.contrast');

require __DIR__.'/auth.php';
