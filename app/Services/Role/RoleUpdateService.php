<?php

namespace App\Services\Role;

use App\Components\Request\DataTransfer;
use App\Models\Role\Role;
use App\Services\BaseService\BaseService;

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
