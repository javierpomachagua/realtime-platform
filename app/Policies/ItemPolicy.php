<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Item $item): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Item $item): bool
    {
        return $user->is_admin;
    }
}
