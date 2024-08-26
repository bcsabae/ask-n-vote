<?php

namespace App\Policies;

use App\Models\SessionCode;
use App\Models\User;

class SessionCodePolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SessionCode $sessionCode): bool
    {
        return $user->id === $sessionCode->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SessionCode $sessionCode): bool
    {
        return $user->id === $sessionCode->user_id;
    }
}
