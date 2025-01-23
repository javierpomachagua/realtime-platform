<?php

use App\Models\Auction;
use App\Models\Item;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            'items' => Item::query()
                ->simplePaginate(6)
        ];
    }

    #[On('item-deleted')]
    public function refresh(): void
    {
    }
}; ?>

<div>
    <a href="{{ route('items.create') }}" wire:navigate>
        <x-primary-button>{{ __('New') }}</x-primary-button>
    </a>
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @foreach($items as $item)
            <x-items.card :$item/>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $items->links() }}
    </div>
</div>
