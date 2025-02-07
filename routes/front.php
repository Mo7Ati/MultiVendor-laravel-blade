<?php

namespace Routes;

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('', function () {
    return view('front.index');
})->name('home');

Route::get('prodcut/{product:slug}', [ProductController::class, 'show'])
    ->name('product.show');

Route::resources([
    'cart' => CartController::class,
    'check-out' => CheckoutController::class,
]);