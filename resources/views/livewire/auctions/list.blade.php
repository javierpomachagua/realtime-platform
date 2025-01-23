<?php

use App\Models\Auction;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            'auctions' => Auction::query()
                ->with(['item'])
                ->simplePaginate(6)
        ];
    }

    #[On('auction-finished')]
    public function refresh(): void
    {
    }
}; ?>

<div>
    @if(auth()->user()->is_admin)
        <a href="{{ route('auctions.create') }}" wire:navigate>
            <x-primary-button>{{ __('New') }}</x-primary-button>
        </a>
    @endif
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @foreach($auctions as $auction)
            <x-auctions.card :$auction wire:key="{{ $auction->id }}"/>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $auctions->links() }}
    </div>
</div>
