<?php

namespace Database\Factories\User;

use App\Models\User\User;
use Eerzho\LaravelComponents\Components\UniqueValue\MakeUniqueValue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'username'   => MakeUniqueValue::getValue('users', 'username', $this->faker->userName),
            'email'      => MakeUniqueValue::getValue('users', 'email', $this->faker->email),
            'password'   => Hash::make('password'),
        ];
    }
}
