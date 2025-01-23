@php use App\Enums\AuctionStatus; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Auction') }} - {{ $auction->id }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 text-gray-900">
            <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                    <div class="ml-4 mt-4">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <img class="size-24 rounded-full"
                                     src="{{ $auction->item->getFirstMediaUrl() ?: 'https://media.istockphoto.com/id/1197832105/vector/male-hand-holding-megaphone-with-new-product-speech-bubble-loudspeaker-banner-for-business.jpg?s=612x612&w=0&k=20&c=INIM5M-N2DZh6pS6DUBSGh7x9ItOBSC3atZOVJtQf7M=' }}"
                                     alt="">
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-semibold text-gray-900">{{ $auction->item->name }}</h3>
                                <x-auctions.status :status="$auction->status->value"/>
                                <span
                                    class="block text-gray-600 text-sm mt-2">End time: {{ $auction->end_time->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="ml-4 mt-4 flex shrink-0">
                        <span>Current Price: {{ Number::currency($auction->current_price) }}</span>
                    </div>
                </div>

                <div class="flow-root mt-10">
                    <ul role="list" class="-mb-8">
                        @forelse($auction->bids as $key => $bid)
                            <li>
                                <div class="relative pb-8">
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"
                                      aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                        <span
                                            class="flex size-8 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white">
                                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                               stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
</svg>

                                        </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    @if(auth()->user()->is_admin)
                                                        {{ $bid->user->name }} bid {{ Number::currency($bid->amount) }}
                                                    @elseif($bid->user_id === auth()->id())
                                                        You bid {{ $bid->amount }}
                                                    @else
                                                        Other user bid {{ Number::currency($bid->amount) }}
                                                    @endif

                                                    @if($key === 0 && $auction->status === AuctionStatus::Closed && $auction->winner_id === $bid->user_id)
                                                        <span class="bg-yellow-300 rounded-xl p-2">Winner</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                <time>{{ $bid->created_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li>
                                <div class="relative pb-8">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <p class="text-sm text-gray-500">No bids yet</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{ route('auctions.index') }}" wire:navigate>
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
