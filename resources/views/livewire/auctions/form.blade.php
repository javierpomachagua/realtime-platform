<?php

use App\Enums\AuctionStatus;
use App\Models\Auction;
use App\Models\Item;
use Carbon\Carbon;
use Livewire\Volt\Component;

new class extends Component {
    public int $item_id;
    public string $start_time;
    public string $end_time;
    public string $starting_price;

    public function with(): array
    {
        return [
            'items' => Item::query()
                ->whereDoesntHave('auctions')
                ->get()
        ];
    }

    public function createAuction(): void
    {
        $this->authorize('create', Auction::class);

        $validated = $this->validate([
            'item_id' => 'required|exists:items,id',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_time',
            'starting_price' => 'required|numeric',
        ]);

        if (Carbon::parse($validated['start_time'])->isPast()) {
            $validated['status'] = AuctionStatus::Active;
        } else {
            $validated['status'] = AuctionStatus::Pending;
        }

        $validated['current_price'] = $validated['starting_price'];

        Auction::create($validated);

        session()->flash('flash.banner', 'Auction saved successfully.');

        $this->redirectRoute('auctions.index', navigate: true);
    }
}; ?>

<form wire:submit="createAuction">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Auction Information</h2>
            <p class="mt-1 text-sm/6 text-gray-600">You can create auction for items that don't have auctions yet</p>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="col-span-full">
                    <x-input-label for="name" :value="__('Items without auction')"/>
                    <select wire:model="item_id" id="item_id"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="{{ null }}">{{ __('Choose an item') }}</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} - Reference
                                price: {{ $item->price }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('item_id')" class="mt-2"/>
                </div>

                <div class="col-span-full">
                    <x-input-label for="starting_price" :value="__('Starting price')"/>
                    <x-text-input type="number" wire:model="starting_price" id="starting_price"
                                  class="block w-full rounded-md"/>
                    <x-input-error :messages="$errors->get('starting_price')" class="mt-2"/>
                </div>

                <div class="col-span-full">
                    <x-input-label for="start_time" :value="__('Start time')"/>
                    <x-text-input type="datetime-local" wire:model="start_time" id="start_time"
                                  class="block w-full rounded-md"/>
                    <x-input-error :messages="$errors->get('start_time')" class="mt-2"/>
                    <span
                        class="mt-1 text-gray-700 text-sm">If the start time is after now, the auction will be active</span>
                </div>

                <div class="col-span-full">
                    <x-input-label for="end_time" :value="__('End time')"/>
                    <x-text-input type="datetime-local" wire:model="end_time" id="end_time"
                                  class="block w-full rounded-md"/>
                    <x-input-error :messages="$errors->get('end_time')" class="mt-2"/>
                </div>

            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a wire:navigate href="{{ route('auctions.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
        <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Save
        </button>
    </div>
</form>
