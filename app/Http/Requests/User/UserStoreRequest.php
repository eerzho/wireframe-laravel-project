<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;

class UserStoreRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'last_name'  => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'username'   => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('users', 'username')
            ],
            'email'      => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')
            ],
            'password'   => [
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed'
            ]
        ];
    }
}
