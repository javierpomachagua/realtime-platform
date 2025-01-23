@props(['auction'])

@php
    use App\Enums\AuctionStatus;

    $statusColors = [
        AuctionStatus::Pending->value => 'bg-blue-100 text-blue-800',
        AuctionStatus::Active->value => 'bg-green-100 text-green-800',
        AuctionStatus::Closed->value => 'bg-gray-100 text-gray-800',
    ];
@endphp

<article class="bg-white flex flex-col items-start">
    <div class="relative w-full">
        <img
            src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80"
            alt=""
            class="aspect-video w-full rounded-t-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
        <div class="absolute inset-0 rounded-t-2xl ring-1 ring-inset ring-gray-900/10"></div>
    </div>
    <div class="w-full px-4 py-2 rounded-b-2xl">
        <div class="mt-2 flex items-center gap-x-4 text-xs">
            <span class="text-gray-500">
                {{ $auction->end_time->diffForHumans() }}
            </span>
            <span href="#"
                  class="relative z-10 rounded-full  px-3 py-1.5 font-medium uppercase {{ $statusColors[$auction->status->value] }}">{{ $auction->status->value }}</span>
        </div>
        <div class="group relative">
            <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
                <span class="absolute inset-0"></span>
                {{ $auction->item->name }}
            </h3>
            <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">
                {{ $auction->item->description }}
            </p>
        </div>
        <div class="relative mt-4 flex justify-between items-center gap-x-4">
            <div class="text-sm/6">
                <p class="font-semibold text-gray-900">
                    Price
                </p>
                <p x-data="{ currentPrice: '{{ \Illuminate\Support\Number::currency($auction->current_price) }}' }"
                   x-on:bid-placed-{{ $auction->id }}.window="currentPrice = $event.detail.bid"
                   x-on:external-bid-placed-{{ $auction->id }}.window="currentPrice = $event.detail.bid"
                   class="text-green-600 text-xl" x-text="currentPrice"></p>
            </div>
        </div>
        @if($auction->status === AuctionStatus::Active && ! auth()->user()->is_admin)
            <div class="mt-4">
                <livewire:auctions.place-bid wire:key="place-bid-{{ $auction->id }}" :$auction/>
            </div>
        @endif
        @if($auction->status === AuctionStatus::Active && auth()->user()->is_admin)
            <livewire:auctions.actions wire:key="actions-{{ $auction->id }}" :$auction/>
        @endif
    </div>
</article>
