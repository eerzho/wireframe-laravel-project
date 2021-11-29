<?php

namespace App\Models\User\Checkers;

use App\Constants\Roles\RoleConst;
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
        return $this->user->roles()->where('value', RoleConst::ADMIN)->exists();
    }
}
