<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResource\BaseResource;
use App\Http\Resources\Role\RoleResource;

class UserResource extends BaseResource
{
    /**
     * @return string[]
     */
    public static function getFields(): array
    {
        return [
            'id',
            'first_name',
            'last_name',
            'username',
            'email',
            'created_at',
            'roles' => RoleResource::class,
        ];
    }
}
