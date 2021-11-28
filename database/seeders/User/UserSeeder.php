<?php

namespace Database\Seeders\User;

use App\Components\UniqueValue\MakeUniqueValue;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = self::createUser(30);

        self::customizeUser($users->get(0), 'eerzho');
        self::customizeUser($users->get(1), 'eerzho');
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

    /**
     * @param User   $user
     * @param string $username
     *
     * @return User
     */
    private static function customizeUser(User $user, string $username)
    {
        $user->username = MakeUniqueValue::getValue('users', 'username', $username);

        $user->save();

        return $user;
    }
}
