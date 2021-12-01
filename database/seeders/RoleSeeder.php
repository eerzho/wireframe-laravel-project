<?php

namespace Database\Seeders;

use App\Constants\Roles\RoleConst;
use App\Models\Role\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        RoleConst::getCollection()->each(function ($item) {
            self::createRole($item['name'], $item['value']);
        });
    }

    /**
     * @param string $name
     * @param int    $value
     *
     * @return Role
     */
    public function createRole(string $name, int $value)
    {
        $role = new Role();

        $role->name = $name;
        $role->value = $value;

        $role->save();

        return $role->refresh();
    }
}
