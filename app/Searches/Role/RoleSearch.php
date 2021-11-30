<?php

namespace App\Searches\Role;

use App\Models\Role\Role;
use Eerzho\LaravelComponents\Searches\BaseSearch\BaseSearch;

class RoleSearch extends BaseSearch
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
        return Role::class;
    }

    /**
     * @return string[]
     */
    protected function getSorts(): array
    {
        return [
            'id',
            '-id',
            'name',
            '-name',
            'value',
            '-value',
        ];
    }
}
