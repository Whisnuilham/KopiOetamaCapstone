<?php

use App\Http\Controllers\ProfileController;
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
    Route::prefix('products-stock')->group(function () {
        Route::get('/',function(){
            return view('pages.products_stock');
         })->name('products_stock');
    });
    Route::prefix('users')->group(function () {
        Route::get('/',function(){
            return view('pages.users');
         })->name('users');
    });
    Route::prefix('product')->group(function () {
        Route::get('/',function(){
            return view('pages.product');
         })->name('product');
    });
    Route::prefix('penjualan')->group(function () {
        Route::get('/',function(){
            return view('pages.penjualan');
         })->name('penjualan');
    });
});

require __DIR__.'/auth.php';

