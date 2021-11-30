<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Role\RoleResource;
use Eerzho\LaravelComponents\Http\Resources\BaseResource\BaseResource;

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
