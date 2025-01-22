<?php

use App\Actions\PlaceBid;
use App\Events\BidPlaced;
use App\Models\Auction;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public Auction $auction;

    public int $bid;

    public function mount(): void
    {
        $this->bid = $this->auction->current_price;
    }

    public function placeBid(PlaceBid $placeBid): void
    {
        $this->validate([
            'bid' => ['required', 'numeric', 'min:'.$this->auction->current_price + 1]
        ]);

        $placeBid->handle($this->auction, $this->bid);

        $this->dispatch('bid-placed-'.$this->auction->id, bid: Number::currency($this->bid));

        BidPlaced::dispatch($this->auction);
    }

    #[On('echo-private:auctions.{auction.id},BidPlaced')]
    public function newExternalBidPlaced(): void
    {
        $this->bid = $this->auction->refresh()->current_price;
        $this->dispatch('external-bid-placed-'.$this->auction->id, bid: Number::currency($this->bid));
    }
}; ?>

<div>
    <p class="font-semibold text-gray-900 text-sm/6">
        Your bid
    </p>
    <form wire:submit="placeBid" class="flex flex-col">
        <div class="flex">
            <x-text-input label="Bid" type="number" wire:model="bid" wire:keydown.enter="placeBid"/>
            <x-primary-button class="ml-2">Place</x-primary-button>
        </div>
        <x-action-message class="mt-3" on="bid-placed-{{ $auction->id }}">
            {{ __('Placed.') }}
        </x-action-message>
        <x-action-message class="mt-3" on="external-bid-placed-{{ $auction->id }}">
            {{ __('New bid from other user!') }}
        </x-action-message>
        <x-input-error :messages="$errors->get('bid')" class="mt-2"/>
    </form>
</div>
