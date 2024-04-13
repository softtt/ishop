<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::domain(config('custom.crm_domain'))->get('/', function () {
    return Inertia::render('Crm/Welcome', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('crm.welcome');

Route::domain(config('custom.crm_domain'))->middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return Inertia::render('Crm/Dashboard');
    })->name('crm.dashboard');
});

require __DIR__ . '/auth.php';