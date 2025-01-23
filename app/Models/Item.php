<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Item extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    use InteractsWithMedia;

    public function auctions(): HasMany
    {
        return $this->hasMany(Auction::class);
    }
}
