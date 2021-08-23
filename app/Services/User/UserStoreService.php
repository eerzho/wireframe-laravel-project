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
class UserStoreService extends BaseService
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
        $this->user->email = $this->request->get('email');
        $this->user->password = Hash::make($this->request->get('password'));

        return $this->user->save();
    }
}
