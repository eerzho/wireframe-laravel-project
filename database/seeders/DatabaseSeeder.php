<?php

namespace Database\Seeders;

use Database\Seeders\Role\RoleSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
