<?php

use App\Actions\PlaceBid;
use App\Events\BidPlaced;
use App\Models\Auction;
use App\Models\Item;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public Auction $auction;

    public function finishAuction(): void
    {
        $this->authorize('finish', $this->auction);

        $this->auction->finish();

        $this->dispatch('auction-finished');

        $this->dispatch('banner-message', style: 'success',
            message: 'Auction finished successfully.');
    }
}; ?>

<div>
    <x-secondary-button wire:click="finishAuction">Finish</x-secondary-button>
</div>
