<?php

namespace Database\Seeders\User;

use App\Models\User\User;
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
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public static function createUser(int $num = 1)
    {
        return User::factory($num)->make()->each(function (User $user) {
            $user->save();
        });
    }
}
