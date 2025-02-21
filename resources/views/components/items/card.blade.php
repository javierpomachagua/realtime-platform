@props(['item'])

<article class="bg-white flex flex-col items-start">
    <div class="relative w-full">
        <img
            src="{{ $item->getFirstMediaUrl() ?: 'https://media.istockphoto.com/id/1197832105/vector/male-hand-holding-megaphone-with-new-product-speech-bubble-loudspeaker-banner-for-business.jpg?s=612x612&w=0&k=20&c=INIM5M-N2DZh6pS6DUBSGh7x9ItOBSC3atZOVJtQf7M=' }}"
            alt=""
            class="aspect-video w-full rounded-t-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
        <div class="absolute inset-0 rounded-t-2xl ring-1 ring-inset ring-gray-900/10"></div>
    </div>
    <div class="w-full px-4 py-2 rounded-b-2xl">
        <div class="group relative">
            <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
                <span class="absolute inset-0"></span>
                {{ $item->name }}
            </h3>
            <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">
                {{ $item->description }}
            </p>
        </div>
        <div class="relative mt-4 flex justify-between items-center gap-x-4">
            <div class="text-sm/6">
                <p class="font-semibold text-gray-900">
                    Price
                </p>
                <p class="text-green-600 text-xl">{{ \Illuminate\Support\Number::currency($item->price) }}</p>
            </div>
        </div>
        <div class="mt-4">
            <livewire:items.actions wire:key="item-{{ $item->id }}" :$item/>
        </div>
    </div>
</article>
