<?php

namespace App\Policies;

use App\Enums\AuctionStatus;
use App\Models\Auction;
use App\Models\User;

class AuctionPolicy
{
    public function view(User $user, Auction $auction): true
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Auction $auction): bool
    {
        return $user->is_admin;
    }

    public function finish(User $user, Auction $auction): bool
    {
        return $user->is_admin && $auction->status === AuctionStatus::Active;
    }
}
