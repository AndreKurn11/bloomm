<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\LocationController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.show');

// Cart (API-style untuk AJAX)
Route::post('/cart/add',    [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/count',   [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/items',   [CartController::class, 'items'])->name('cart.items');

// Checkout
// PENTING: /checkout/session harus didaftarkan SEBELUM /checkout/{anything}
// supaya tidak tertangkap sebagai wildcard
Route::post('/checkout/session', [CheckoutController::class, 'storeSession'])->name('checkout.session');
Route::get('/checkout',          [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout',         [CheckoutController::class, 'process'])->name('checkout.process');

// Receipt
Route::get('/receipt/{orderId}', [ReceiptController::class, 'show'])->name('receipt.show');

// Location
Route::get('/location', [LocationController::class, 'index'])->name('location');

// Career
Route::view('/career', 'pages.career')->name('career');