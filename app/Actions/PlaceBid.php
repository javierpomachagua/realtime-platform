<?php

namespace App\Actions;

use App\Enums\AuctionStatus;
use App\Models\Auction;
use RuntimeException;

class PlaceBid
{
    public function handle(Auction $auction, int $amount): void
    {
        if ($amount <= $auction->current_price) {
            throw new RuntimeException('The bid amount must be greater than the current price.');
        }

        if ($auction->status !== AuctionStatus::Active) {
            throw new RuntimeException('The auction is not active.');
        }

        $auction->bids()->create([
            'user_id' => auth()->id(),
            'amount' => $amount,
        ]);

        $auction->update([
            'current_price' => $amount,
        ]);
    }
}
