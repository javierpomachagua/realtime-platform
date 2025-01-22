<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('auctions.{auctionId}', function ($user, $auctionId) {
    return auth()->check();
});
