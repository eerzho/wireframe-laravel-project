<?php

namespace App\Policies;

use App\Constants\Messages\AccessDeniedMessage;
use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     *
     * @return Response
     */
    public function viewAny(User $user)
    {
        return Response::allow();
    }

    /**
     * @param User $user
     * @param Role $role
     *
     * @return Response
     */
    public function view(User $user, Role $role)
    {
        return Response::allow();
    }

    /**
     * @param User $user
     * @param Role $role
     *
     * @return Response
     */
    public function update(User $user, Role $role)
    {
        return Response::deny(AccessDeniedMessage::DELETE);
    }
}
