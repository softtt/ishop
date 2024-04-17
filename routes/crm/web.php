<?php


use App\Http\Controllers\Crm\CategoryController;
use App\Http\Controllers\Crm\OrderController;
use App\Http\Controllers\Crm\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Crm\DashboardController;

Route::domain(config('custom.crm_domain'))->get('/', function () {
    return Inertia::render('Crm/Welcome', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('crm.welcome');

Route::domain(config('custom.crm_domain'))
    ->middleware(['auth'])
    ->resource('categories', CategoryController::class)->except('show');

Route::domain(config('custom.crm_domain'))
    ->middleware(['auth'])
    ->resource('products', ProductController::class)->except(['show', 'update', 'index']);

Route::domain(config('custom.crm_domain'))->middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('crm.dashboard');
    Route::post('categories/toggleActiveStatus/{category}', [CategoryController::class, 'toggleActiveStatus'])
        ->name('categories.toggleActiveStatus');

    Route::post('products/deleteCover/{product}', [ProductController::class, 'deleteCover'])->name('products.deleteCover');
    Route::post('products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('products/{category?}', [ProductController::class, 'index'])->name('products.index');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/markAsCompleted/{order}', [OrderController::class, 'markAsCompleted'])->name('orders.markAsCompleted');
});



require __DIR__ . '/auth.php';