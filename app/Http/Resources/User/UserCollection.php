<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResource\BaseCollection;

class UserCollection extends BaseCollection
{
    /**
     * @return string
     */
    protected function getCollects(): string
    {
        return UserResource::class;
    }
}
