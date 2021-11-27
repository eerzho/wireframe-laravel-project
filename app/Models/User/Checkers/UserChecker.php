<?php

namespace App\Models\User\Checkers;

use App\Models\User\User;

class UserChecker
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->user->id == 1;
    }
}
