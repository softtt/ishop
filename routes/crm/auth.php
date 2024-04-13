<?php


use App\Http\Controllers\Crm\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Crm\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;


Route::domain(config('custom.crm_domain'))->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('crm.register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('crm.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('crm.logout');
});
