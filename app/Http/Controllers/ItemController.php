<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }
}
