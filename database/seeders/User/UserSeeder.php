<?php

namespace Database\Seeders\User;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        self::createUser(30);
    }

    /**
     * @param int $num
     *
     * @return Collection|Model
     */
    public static function createUser(int $num = 1)
    {
        return User::factory($num)->make()->each(function (User $user) {
            $user->save();
        });
    }
}
