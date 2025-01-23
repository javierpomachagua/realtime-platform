<?php

namespace App\Policies;

use App\Models\User;

class BidPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return ! $user->is_admin;
    }
}
