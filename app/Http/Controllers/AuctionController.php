<?php

namespace App\Http\Controllers;

use App\Models\Auction;

class AuctionController extends Controller
{
    public function show(Auction $auction)
    {
        $auction->load([
            'bids' => fn ($query) => $query->latest(),
            'bids.user',
        ]);

        return view('auctions.show', compact('auction'));
    }
}
