<?php

namespace App\Repositories\Role;

use App\Models\Role\Role;
use App\Searches\Role\RoleSearch;
use Eerzho\LaravelComponents\Components\Request\DataTransfer;
use Eerzho\LaravelComponents\Interfaces\Search\SearchInterface;
use Eerzho\LaravelComponents\Repositories\BaseRepository\BaseRepository;
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
        $data = new DataTransfer($request->query());

        return new RoleSearch($data);
    }

    /**
     * @param int $value
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getByValue(int $value)
    {
        return $this->startQuery()->where('value', $value)->firstOrFail();
    }
}
