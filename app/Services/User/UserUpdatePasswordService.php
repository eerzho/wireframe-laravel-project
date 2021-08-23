<?php

namespace App\Services\User;

use App\Components\Request\DataTransfer;
use App\Models\User\User;
use App\Services\BaseService\BaseService;
use Illuminate\Support\Facades\Hash;

/**
 * @property User         $user
 * @property DataTransfer $request
 */
class UserUpdatePasswordService extends BaseService
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
        if (Hash::check($this->request->get('old_password'), $this->user->password)) {
            $this->user->password = Hash::make($this->request->get('password'));

            return $this->user->save();
        }

        return false;
    }
}
