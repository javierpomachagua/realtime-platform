<?php

namespace App\Http\Controllers;

use App\Models\Auction;

class AuctionController extends Controller
{
    public function show(Auction $auction)
    {
        return view('auctions.show', compact('auction'));
    }
}
