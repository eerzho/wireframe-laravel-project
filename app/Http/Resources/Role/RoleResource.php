<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\BaseResource\BaseResource;

class RoleResource extends BaseResource
{
    /**
     * @return string[]
     */
    public static function getFields(): array
    {
        return [
            'id',
            'name',
            'value',
        ];
    }
}
