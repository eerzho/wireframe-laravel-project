<?php

namespace App\Searches\User;

use App\Models\User\User;
use Eerzho\LaravelComponents\Searches\BaseSearch\BaseSearch;

class UserSearch extends BaseSearch
{
    /**
     * @return string
     */
    protected function getNamespace(): string
    {
        return __NAMESPACE__;
    }

    /**
     * @return string
     */
    protected function getModel(): string
    {
        return User::class;
    }

    /**
     * @return string[]
     */
    protected function getSorts(): array
    {
        return [
            'id',
            '-id',
            'username',
            '-username',
            'created_at',
            '-created_at',
        ];
    }
}
