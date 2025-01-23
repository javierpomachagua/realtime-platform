<?php

use App\Actions\PlaceBid;
use App\Events\BidPlaced;
use App\Models\Auction;
use App\Models\Item;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public Item $item;

    public function deleteItem(): void
    {
        $this->authorize('delete', $this->item);

        if ($this->item->auctions()->exists()) {
            $this->dispatch('banner-message', style: 'danger',
                message: ' This item is associated with an auction and cannot be deleted.');

            return;
        }

        $this->item->delete();

        $this->dispatch('item-deleted');

        $this->dispatch('banner-message', style: 'success',
            message: 'Item deleted successfully.');
    }
}; ?>

<div class="flex items-center space-x-4">
    <a wire:navigate href="{{ route('items.edit', $item) }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
        </svg>
    </a>
    <button wire:click="deleteItem">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
        </svg>
    </button>
</div>
