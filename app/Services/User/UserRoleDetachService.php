<?php

namespace App\Services\User;

use App\Models\User\User;
use Eerzho\LaravelComponents\Components\Request\DataTransfer;
use Eerzho\LaravelComponents\Services\BaseService\BaseService;

/**
 * @property User         $user
 * @property DataTransfer $request
 */
class UserRoleDetachService extends BaseService
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
        try {
            $this->user->roles()->detach($this->request->get('roles'));

            return true;
        } catch (\Throwable $exception) {
            return false;
        }
    }
}
