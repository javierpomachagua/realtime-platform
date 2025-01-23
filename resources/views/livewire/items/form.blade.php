<?php

use App\Models\Auction;
use App\Models\Item;
use Livewire\Volt\Component;

new class extends Component {

    public ?Item $item = null;

    public string $name = '';
    public string $description = '';
    public string $price = '';

    public function mount(): void
    {
        if ($this->item?->exists()) {
            $this->name = $this->item->name;
            $this->description = $this->item->description;
            $this->price = $this->item->price;
        }
    }

    public function createOrUpdateItem(): void
    {
        $validated = $this->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($this->item?->exists()) {
            $this->authorize('update', $this->item);

            $this->item->update($validated);

            session()->flash('flash.banner', 'Item updated successfully.');
        } else {
            $this->authorize('create', Item::class);

            Item::create($validated);

            session()->flash('flash.banner', 'Item saved successfully.');
        }

        $this->redirectRoute('items.index', navigate: true);
    }
}; ?>

<form wire:submit="createOrUpdateItem">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Item Information</h2>
            <p class="mt-1 text-sm/6 text-gray-600">This information is about the item features.</p>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="col-span-full">
                    <x-input-label for="name" :value="__('Name')"/>
                    <x-text-input wire:model="name" id="name" class="block w-full rounded-md"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <div class="col-span-full">
                    <x-input-label for="description" :value="__('Description')"/>
                    <textarea wire:model="description" id="description" rows="4"
                              class="block border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                </div>

                <div class="col-span-full">
                    <x-input-label for="price" :value="__('Price')"/>
                    <x-text-input wire:model="price" type="number" id="price" class="block w-full rounded-md"/>
                    <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a wire:navigate href="{{ route('items.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
        <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Save
        </button>
    </div>
</form>
