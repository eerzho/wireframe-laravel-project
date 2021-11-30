<?php

namespace App\Http\Requests\Auth;

use Eerzho\LaravelComponents\Http\Requests\BaseFromRequest\BaseFromRequest;
use Illuminate\Validation\Rule;

class AuthForgotRequest extends BaseFromRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                Rule::exists('users', 'email')
            ],
        ];
    }
}
