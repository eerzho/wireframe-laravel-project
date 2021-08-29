<?php

namespace App\Http\Requests\User;

class UserUpdatePasswordRequest
{
    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'password'     => [
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed'
            ],
            'old_password' => [
                'required',
                'string',
                'min:8',
                'max:255'
            ]
        ];
    }
}
