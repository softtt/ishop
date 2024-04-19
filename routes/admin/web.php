<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Enums\Roles;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StoreController;

Route::prefix('admin')->get('/', function () {
    return Inertia::render('Admin/Welcome', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('admin.welcome');

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');
});

Route::prefix('admin')
    ->middleware('role:' . Roles::SuperAdmin->name)
    ->group(function () {
        Route::post('stores/toggleActiveStatus/{store}', [StoreController::class, 'toggleActiveStatus'])
            ->name('stores.toggleActiveStatus');
        Route::post('users/toggleAdminAccess/{user}', [UserController::class, 'toggleAdminAccess'])
            ->name('users.toggleAdminAccess');
    });

Route::prefix('admin')
    ->middleware('role:' . Roles::SuperAdmin->name)
    ->resource('users', UserController::class)->except('show');

Route::prefix('admin')
    ->middleware('role:' . Roles::SuperAdmin->name)
    ->resource('stores', StoreController::class)->except('show');

require __DIR__ . '/auth.php';