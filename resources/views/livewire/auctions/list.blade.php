<?php

use App\Models\Auction;
use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'auctions' => Auction::query()
                ->with(['item'])
                ->get()
        ];
    }
}; ?>

<div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
    @foreach($auctions as $auction)
        <x-auctions.card
            :name="$auction->item->name"
            :status="$auction->status->value"
            :description="$auction->item->description"
            :end-time="$auction->end_time->diffForHumans()"
            :current-price="$auction->current_price"
        />
    @endforeach
</div>
