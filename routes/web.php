<?php

use App\Http\Controllers\ItemController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('auctions', 'auctions.index')
    ->middleware(['auth', 'verified'])
    ->name('auctions.index');

Route::view('auctions/create', 'auctions.create')
    ->middleware(['auth', 'verified'])
    ->name('auctions.create');

Route::view('items', 'items.index')
    ->middleware(['auth', 'verified', EnsureIsAdmin::class])
    ->name('items.index');

Route::view('items/create', 'items.create')
    ->middleware(['auth', 'verified', EnsureIsAdmin::class])
    ->name('items.create');

Route::get('items/{item}/edit', [ItemController::class, 'edit'])
    ->middleware(['auth', 'verified', EnsureIsAdmin::class])
    ->name('items.edit');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
