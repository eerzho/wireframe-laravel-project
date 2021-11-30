<?php

namespace App\Services\User;

use App\Components\Request\DataTransfer;
use App\Models\User\User;
use App\Services\BaseService\BaseService;

/**
 * @property User         $user
 * @property DataTransfer $request
 */
class UserUpdateService extends BaseService
{
    private User $user;
    private DataTransfer $request;

    /**
     * @param User         $user
     * @param DataTransfer $request
     */
    public function __construct(User $user, DataTransfer $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        $this->user->first_name = $this->request->get('first_name');
        $this->user->last_name = $this->request->get('last_name');
        $this->user->username = $this->request->get('username');

        if ($email = $this->request->get('email') && $this->user->email != $this->request->get('email')) {
            $this->user->email = $email;
            $this->user->email_verified_at = null;
        }
        $this->user->email = $this->request->get('email');

        return $this->user->save();
    }
}
