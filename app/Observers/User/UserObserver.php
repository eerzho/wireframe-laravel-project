<?php

namespace App\Observers\User;

use App\Events\DeleteToken;
use App\Models\User\User;
use Illuminate\Auth\Events\Registered;

class UserObserver
{
    /**
     * @param User $user
     */
    public function created(User $user)
    {
        event(new Registered($user));
    }

    /**
     * @param User $user
     */
    public function deleted(User $user)
    {
        event(new DeleteToken($user));
    }
}
