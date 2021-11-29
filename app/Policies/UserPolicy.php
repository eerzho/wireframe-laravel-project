<?php

namespace App\Policies;

use App\Constants\Messages\AccessDeniedMessage;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     *
     * @return Response
     */
    public function viewAny(User $user)
    {
        return Response::deny(AccessDeniedMessage::SHOW);
    }

    /**
     * @param User $user
     * @param User $model
     *
     * @return Response
     */
    public function view(User $user, User $model)
    {
        return $user->id == $model->id ?
            Response::allow() :
            Response::deny(AccessDeniedMessage::SHOW);
    }

    /**
     * @param User $user
     * @param User $model
     *
     * @return Response
     */
    public function update(User $user, User $model)
    {
        return $user->id == $model->id ?
            Response::allow() :
            Response::deny(AccessDeniedMessage::UPDATE);
    }

    /**
     * @param User $user
     * @param User $model
     *
     * @return Response
     */
    public function delete(User $user, User $model)
    {
        return $user->id == $model->id ?
            Response::allow() :
            Response::deny(AccessDeniedMessage::DELETE);
    }

    /**
     * @param User $user
     * @param User $model
     *
     * @return Response
     */
    public function editRole(User $user, User $model)
    {
        return Response::deny(AccessDeniedMessage::UPDATE);
    }
}
