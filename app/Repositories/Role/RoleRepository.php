<?php

namespace App\Repositories\Role;

use App\Interfaces\Search\SearchInterface;
use App\Models\Role\Role;
use App\Repositories\BaseRepository\BaseRepository;
use App\Searches\Role\RoleSearch;
use Illuminate\Http\Request;

class RoleRepository extends BaseRepository implements SearchInterface
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return Role::class;
    }

    /**
     * @param Request $request
     *
     * @return RoleSearch
     */
    public function search(Request $request)
    {
        return new RoleSearch($request);
    }
}
