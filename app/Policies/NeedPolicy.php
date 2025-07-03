<?php

namespace App\Policies;

use App\Models\Need;
use App\Models\User;

class NeedPolicy
{
    public function delete(User $user, Need $need): bool
    {
        return $user->id === $need->user_id;
    }
} 