<?php

use App\Models\Auction;
use Livewire\Attributes\On;
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
            <x-auctions.card :$auction/>
        @endforeach
    </div>
</div>
