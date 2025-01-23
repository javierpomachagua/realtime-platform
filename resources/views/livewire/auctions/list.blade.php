<?php

use App\Models\Auction;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Locked]
    public bool $won = false;

    public function with(): array
    {
        return [
            'auctions' => Auction::query()
                ->with(['item'])
                ->when($this->won && !auth()->user()->is_admin,
                    fn($query) => $query->where('winner_id', auth()->user()->id))
                ->simplePaginate(6)
        ];
    }

    #[On('auction-finished')]
    public function refresh(): void
    {
    }

    public function toggleWon(): void
    {
        $this->won = !$this->won;
    }
}; ?>

<div>
    @if(auth()->user()->is_admin)
        <a href="{{ route('auctions.create') }}" wire:navigate>
            <x-primary-button>{{ __('New') }}</x-primary-button>
        </a>
    @else
        <x-secondary-button wire:click="toggleWon" class="{{ $won ? 'bg-gray-300 hover:bg-gray-400' : '' }}">My
            Won Auctions
        </x-secondary-button>
    @endif
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @foreach($auctions as $auction)
            <x-auctions.card :$auction/>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $auctions->links() }}
    </div>
</div>
