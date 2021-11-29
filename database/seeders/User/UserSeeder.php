<?php

namespace Database\Seeders\User;

use App\Components\Request\DataTransfer;
use App\Components\UniqueValue\MakeUniqueValue;
use App\Constants\Roles\RoleConst;
use App\Models\Role\Role;
use App\Models\User\User;
use App\Repositories\Role\RoleRepository;
use App\Services\User\UserRoleAttachService;
use App\Services\User\UserRoleDetachService;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        /** @var Role $userRole */
        $userRole = app(RoleRepository::class)->getByValue(RoleConst::USER);
        /** @var Role $adminRole */
        $adminRole = app(RoleRepository::class)->getByValue(RoleConst::ADMIN);

        $users = self::createUser(30)->each(function (User $user) use ($userRole) {
            (new UserRoleAttachService($user, new DataTransfer(['roles' => [$userRole->id]])))->run();
        });

        self::customizeUser($users->get(0), 'eerzho', [$adminRole->id]);
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
     * @param User       $user
     * @param string     $username
     * @param array|null $roles
     *
     * @return User
     */
    private static function customizeUser(User $user, string $username, array $roles = null)
    {
        $user->username = MakeUniqueValue::getValue('users', 'username', $username);

        $user->save();

        if (is_array($roles)) {
            (new UserRoleDetachService($user, new DataTransfer(['roles' => $user->roles()->pluck('role_id')])))->run();
            (new UserRoleAttachService($user, new DataTransfer(['roles' => $roles])))->run();
        }

        return $user;
    }
}
