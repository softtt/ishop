<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Enums\Roles;
use App\Http\Controllers\Admin\UserController;

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
Route::domain(config('custom.admin_domain'))
    ->middleware('role:' . Roles::SuperAdmin->name)
    ->prefix('admin')
    ->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('users/{user}', [UserController::class, 'update']);
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

Route::domain(config('custom.admin_domain'))
    ->middleware('role:' . Roles::SuperAdmin->name)
    ->resource('users', UserController::class)->except('show');

require __DIR__ . '/auth.php';