<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;

Route::middleware(['auth'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');

    Route::get('categories', [ProductCategoryController::class, 'index'])->name('product.category');
    Route::post('categories', [ProductCategoryController::class, 'store']);
    Route::put('categories/{categories}', [ProductCategoryController::class, 'update'])->name('product.category.update');
    Route::delete('categories/{categories}', [ProductCategoryController::class, 'destroy'])->name('product.category.destroy');

    Route::get('product', [ProductController::class, 'index'])->name('product');

    Route::get('sale', [SaleController::class, 'index'])->name('sale');

    Route::post('cart', [CartController::class, 'store'])->name('cart');
    Route::put('cart', [CartController::class, 'checkout']);
    Route::delete('cart', [CartController::class, 'destroy']);
});


require __DIR__ . '/auth.php';
