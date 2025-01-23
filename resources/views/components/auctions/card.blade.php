@props(['auction'])

@php
    use App\Enums\AuctionStatus;
@endphp

<div class="bg-white flex flex-col items-start">
    <div class="relative w-full">
        <img
            src="{{ $auction->item->getFirstMediaUrl() ?: 'https://media.istockphoto.com/id/1197832105/vector/male-hand-holding-megaphone-with-new-product-speech-bubble-loudspeaker-banner-for-business.jpg?s=612x612&w=0&k=20&c=INIM5M-N2DZh6pS6DUBSGh7x9ItOBSC3atZOVJtQf7M=' }}"
            alt=""
            class="aspect-video w-full rounded-t-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
        <div class="absolute inset-0 rounded-t-2xl ring-1 ring-inset ring-gray-900/10"></div>
    </div>
    <div class="w-full px-4 py-2 rounded-b-2xl">
        <div class="mt-2 flex items-center gap-x-4 text-xs">
            <span class="text-gray-500">
                End time: {{ $auction->end_time->diffForHumans() }}
            </span>
            <x-auctions.status :status="$auction->status->value"/>
        </div>
        <div class="group relative">
            <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
                <span class="absolute inset-0"></span>
                {{ $auction->id }} - {{ $auction->item->name }}
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
                <p wire:key="auction-current-price-{{ $auction->id }}"
                   x-data="{ currentPrice: '{{ \Illuminate\Support\Number::currency($auction->current_price) }}' }"
                   x-on:bid-placed-{{ $auction->id }}.window="currentPrice = $event.detail.bid"
                   x-on:external-bid-placed-{{ $auction->id }}.window="currentPrice = $event.detail.bid"
                   class="text-green-600 text-xl"
                   x-text="currentPrice"></p>
            </div>
        </div>
        @if($auction->status === AuctionStatus::Active && ! auth()->user()->is_admin)
            <div class="mt-4">
                <livewire:auctions.place-bid wire:key="place-bid-{{ $auction->id }}" :$auction/>
            </div>
        @endif
        <div>
            <livewire:auctions.actions wire:key="actions-{{ $auction->id }}" :$auction/>
        </div>
    </div>
</div>
