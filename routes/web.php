<?php

use App\Http\Controllers\IngredientStockController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('ingredient-stock')->group(function () {
            Route::get('/', [IngredientStockController::class, 'index'])->name('ingredient_stock');
            Route::post('store', [IngredientStockController::class, 'store'])->name('ingredient_stock.store');
            Route::post('/{id}/update', [IngredientStockController::class, 'update'])->name('ingredient_stock.update');
            Route::delete('/{id}/delete', [IngredientStockController::class, 'destroy'])->name('ingredient_stock.destroy');
    });
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users');
            Route::post('store', [UsersController::class, 'store'])->name('users.store');
            Route::post('/{id}/update', [UsersController::class, 'update'])->name('users.update');
            Route::delete('/{id}/delete', [UsersController::class, 'destroy'])->name('users.destroy');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product');
            Route::post('store', [ProductController::class, 'store'])->name('product.store');
            Route::post('/{id}/update', [ProductController::class, 'update'])->name('product.update');
            Route::delete('/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy');
    });
    Route::prefix('penjualan')->group(function () {
        Route::get('/', [PenjualanController::class, 'index'])->name('penjualan');
            Route::post('store', [PenjualanController::class, 'store'])->name('penjualan.store');
            Route::post('/{id}/update', [PenjualanController::class, 'update'])->name('penjualan.update');
            Route::delete('/{id}/delete', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    });
});

require __DIR__.'/auth.php';

