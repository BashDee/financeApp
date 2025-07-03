<?php

namespace App\Policies;

use App\Models\Want;
use App\Models\User;

class WantPolicy
{
    public function delete(User $user, Want $want): bool
    {
        return $user->id === $want->user_id;
    }
} 