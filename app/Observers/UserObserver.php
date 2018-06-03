<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        if ($user->balance < 0) {
            return false;
        }
    }
}