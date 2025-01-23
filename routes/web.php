<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('auctions', 'auctions.index')
    ->middleware(['auth', 'verified'])
    ->name('auctions.index');

Route::view('auctions/create', 'auctions.create')
    ->middleware(['auth', 'verified', 'can:create,App\Models\Auction'])
    ->name('auctions.create');

Route::get('auctions/{auction}', [AuctionController::class, 'show'])
    ->middleware(['auth', 'verified', 'can:view,auction'])
    ->name('auctions.show');

Route::view('items', 'items.index')
    ->middleware(['auth', 'verified', 'can:viewAny,App\Models\Item'])
    ->name('items.index');

Route::view('items/create', 'items.create')
    ->middleware(['auth', 'verified', 'can:create,App\Models\Item'])
    ->name('items.create');

Route::get('items/{item}/edit', [ItemController::class, 'edit'])
    ->middleware(['auth', 'verified', 'can:update,item'])
    ->name('items.edit');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
