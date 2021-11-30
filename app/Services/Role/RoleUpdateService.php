<?php

namespace App\Services\Role;

use App\Models\Role\Role;
use Eerzho\LaravelComponents\Components\Request\DataTransfer;
use Eerzho\LaravelComponents\Services\BaseService\BaseService;

/**
 * @property Role         $role
 * @property DataTransfer $request
 */
class RoleUpdateService extends BaseService
{
    private Role $role;
    private DataTransfer $request;

    /**
     * @param Role         $role
     * @param DataTransfer $request
     */
    public function __construct(Role $role, DataTransfer $request)
    {
        $this->role = $role;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        $this->role->name = $this->request->get('name');

        return $this->role->save();
    }
}
