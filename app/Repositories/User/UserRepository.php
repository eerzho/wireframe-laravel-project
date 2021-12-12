<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Searches\User\UserSearch;
use Eerzho\LaravelComponents\Components\Request\DataTransfer;
use Eerzho\LaravelComponents\Interfaces\Search\SearchInterface;
use Eerzho\LaravelComponents\Repositories\BaseRepository\BaseRepository;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements SearchInterface
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return User::class;
    }

    /**
     * @param Request $request
     *
     * @return UserSearch
     */
    public function search(Request $request)
    {
        $data = new DataTransfer($request->query());

        return new UserSearch($data);
    }

    /**
     * @param string $email
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getByEmail(string $email)
    {
        return $this->startQuery()->where('email', $email)->firstOrFail();
    }

    /**
     * @param string $username
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getByUsername(string $username)
    {
        return $this->startQuery()->where('username', $username)->firstOrFail();
    }
}
