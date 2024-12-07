<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\TypeparcController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('/sites', [SiteController::class, 'index'])
    ->middleware(['auth'])
    ->name('sites');

Route::get('/typeparcs', [TypeparcController::class, 'index'])
    ->middleware(['auth'])
    ->name('typeparcs');


require __DIR__ . '/auth.php';
