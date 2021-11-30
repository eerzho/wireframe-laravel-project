<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFromRequest\BaseFromRequest;
use Illuminate\Validation\Rule;

class AuthLoginRequest extends BaseFromRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => [
                'required_without:username',
                'string',
                'email',
                Rule::exists('users', 'email'),
            ],
            'username' => [
                'required_without:email',
                'string',
                'min:3',
                'max:255',
                Rule::exists('users', 'username'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
            ]
        ];
    }
}
