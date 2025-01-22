<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('auctions', 'auctions')
    ->middleware(['auth', 'verified'])
    ->name('auctions');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
