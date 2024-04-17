<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreFrontController;

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
Route::domain(config('custom.app_domain'))->get('/', function () {
        return Inertia::render('Welcome');
})->name('welcome');


Route::domain(config('custom.app_domain'))->middleware(['auth'])->group(function () {
    Route::get('/store/{category:slug?}', [StoreFrontController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::post('/checkout', [StoreFrontController::class, 'checkout'])->middleware(['verified'])->name('checkout');
    Route::post('/placeOrder', [StoreFrontController::class, 'placeOrder'])->middleware(['verified'])->name('placeOrder');
    Route::get('/productDetails/{product:slug}/{category:slug?}', [StoreFrontController::class, 'productDetails'])->middleware(['verified'])->name('productDetails');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});