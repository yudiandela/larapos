<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCategoryController;

Route::middleware(['auth'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');

    Route::get('categories', [ProductCategoryController::class, 'index'])->name('product.category');
    Route::post('categories', [ProductCategoryController::class, 'store']);
    Route::put('categories/{categories}', [ProductCategoryController::class, 'update'])->name('product.category.update');
    Route::delete('categories/{categories}', [ProductCategoryController::class, 'destroy'])->name('product.category.destroy');
});


require __DIR__ . '/auth.php';
