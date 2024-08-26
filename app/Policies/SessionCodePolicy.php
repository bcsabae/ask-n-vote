<?php

namespace App\Policies;

use App\Models\SessionCode;
use App\Models\User;

class SessionCodePolicy
{
    public function view(User $user, SessionCode $sessionCode): bool
    {
        return $user->sessionCodes()->where('id', $sessionCode->id)->exists();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, SessionCode $sessionCode): bool
    {
        return $user->id === $sessionCode->user_id;
    }

    public function delete(User $user, SessionCode $sessionCode): bool
    {
        return $user->id === $sessionCode->user_id;
    }
}
