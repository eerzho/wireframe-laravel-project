<?php

namespace App\Http\Requests\User;

use App\Models\User\User;
use Illuminate\Validation\Rule;

/**
 * @property User $user
 */
class UserUpdateRequest
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
                'max:255',
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
                    ->ignore($this->user->id)
            ],
            'email'      => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($this->user->id)
            ]
        ];
    }
}
