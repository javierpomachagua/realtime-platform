@php use App\Enums\AuctionStatus; @endphp
@props(['name', 'description', 'status', 'endTime', 'currentPrice'])

@php
    $statusColors = [
        AuctionStatus::Pending->value => 'bg-blue-100 text-blue-800',
        AuctionStatus::Active->value => 'bg-green-100 text-green-800',
        AuctionStatus::Closed->value => 'bg-gray-100 text-gray-800',
    ];
@endphp

<article class="bg-white flex flex-col items-start justify-between">
    <div class="relative w-full">
        <img
            src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80"
            alt="" class="aspect-video w-full rounded-t-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
        <div class="absolute inset-0 rounded-t-2xl ring-1 ring-inset ring-gray-900/10"></div>
    </div>
    <div class="w-full px-4 py-2 rounded-b-2xl">
        <div class="mt-4 flex items-center gap-x-4 text-xs">
            <span class="text-gray-500">
                {{ $endTime }}
            </span>
            <span href="#"
                  class="relative z-10 rounded-full  px-3 py-1.5 font-medium uppercase {{ $statusColors[$status] }}">{{ $status }}</span>
        </div>
        <div class="group relative">
            <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
                <span class="absolute inset-0"></span>
                {{ $name }}
            </h3>
            <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">
                {{ $description }}
            </p>
        </div>
        <div class="relative mt-8 flex items-center gap-x-4">
            <div class="text-sm/6">
                <p class="font-semibold text-gray-900">
                    <span class="absolute inset-0"></span>
                    Price
                </p>
                <p class="text-gray-600">{{ \Illuminate\Support\Number::currency($currentPrice) }}</p>
            </div>
        </div>
    </div>
</article>
