<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//    return view('home');
// });

// frontend routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('product-details/{product:slug}', [\App\Http\Controllers\ProductController::class, 'productDetails'])->name('product.detail');
Route::controller(\App\Http\Controllers\CartController::class)->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'cart')->name('index');
    Route::post('/add', 'add')->name('add');
    Route::get('/cart/remove/{id}', 'remove')->name('remove');
});
Route::get('checkout', [\App\Http\Controllers\CheckoutController::class,'checkout'])->name('checkout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/edit/{product}', 'edit')->name('edit');
        Route::put('/update/{product}', 'update')->name('update');
        Route::delete('/delete/{product}', 'destroy')->name('destroy');
        Route::get('/product/gallery/delete/{productGallery}', 'deleteProductGallery')->name('gallery.delete');
    });

});

require __DIR__ . '/auth.php';
