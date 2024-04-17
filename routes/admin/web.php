<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Enums\Roles;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StoreController;

Route::domain(config('custom.admin_domain'))->get('/', function () {
    return Inertia::render('Admin/Welcome', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('admin.welcome');

Route::domain(config('custom.admin_domain'))->middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');
});

// Ziggy does not see resource derective declared routes so declaring all routes separately
//Route::domain(config('custom.admin_domain'))
//    ->middleware('role:' . Roles::SuperAdmin->name)
//    ->prefix('admin')
//    ->group(function () {
//        Route::get('users', [UserController::class, 'index'])->name('users.index');
//        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
//        Route::post('users', [UserController::class, 'store'])->name('users.store');
//        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
//        Route::patch('users/{user}', [UserController::class, 'update']);
//        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//        Route::post('users/toggleAdminAccess/{user}', [UserController::class, 'toggleAdminAccess'])->name('users.toggleAdminAccess');
//    });

// Ziggy does not see resource derective declared routes so declaring all routes separately
//Route::domain(config('custom.admin_domain'))
//    ->middleware('role:' . Roles::SuperAdmin->name)
//    ->group(function () {
//        Route::get('stores', [StoreController::class, 'index'])->name('stores.index');
//        Route::get('stores/create', [StoreController::class, 'create'])->name('stores.create');
//        Route::post('stores', [StoreController::class, 'store'])->name('stores.store');
//        Route::get('stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
//        Route::put('stores/{store}', [StoreController::class, 'update'])->name('stores.update');
//        Route::patch('stores/{store}', [StoreController::class, 'update']);
//        Route::delete('stores/{store}', [StoreController::class, 'destroy'])->name('stores.destroy');
//        Route::post('stores/toggleActiveStatus/{store}', [StoreController::class, 'toggleActiveStatus'])->name('stores.toggleActiveStatus');
//    });

Route::domain(config('custom.admin_domain'))
    ->middleware('role:' . Roles::SuperAdmin->name)
    ->group(function () {
        Route::post('stores/toggleActiveStatus/{store}', [StoreController::class, 'toggleActiveStatus'])
            ->name('stores.toggleActiveStatus');
        Route::post('users/toggleAdminAccess/{user}', [UserController::class, 'toggleAdminAccess'])
            ->name('users.toggleAdminAccess');
    });

Route::domain(config('custom.admin_domain'))
    ->middleware('role:' . Roles::SuperAdmin->name)
    ->resource('users', UserController::class)->except('show');

Route::domain(config('custom.admin_domain'))
    ->middleware('role:' . Roles::SuperAdmin->name)
    ->resource('stores', StoreController::class)->except('show');

require __DIR__ . '/auth.php';