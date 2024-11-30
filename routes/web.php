<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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


// Route::middleware('auth')->group(function () {
//     Volt::route('sites', 'livewire.pages.sites')
//         ->name('sites');
// });



Route::view('typeparcs', 'typeparcs')
    ->middleware(['auth'])
    ->name('typeparcs');

require __DIR__ . '/auth.php';
