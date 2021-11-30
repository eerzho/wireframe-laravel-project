<?php

namespace App\Http\Requests\Auth;

use Eerzho\LaravelComponents\Http\Requests\BaseFromRequest\BaseFromRequest;

class AuthResetRequest extends BaseFromRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
            ],
            'password'   => [
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed'
            ],
            'token' => [
                'required',
                'string',
            ]
        ];
    }
}
