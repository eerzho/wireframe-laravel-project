<?php

namespace App\Repositories\User;

use App\Interfaces\Search\SearchInterface;
use App\Searches\User\UserSearch;
use Illuminate\Http\Request;

class UserRepository implements SearchInterface
{
    /**
     * @param Request $request
     *
     * @return UserSearch
     */
    public function search(Request $request)
    {
        return new UserSearch($request);
    }
}
