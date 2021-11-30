<?php

namespace App\Http\Requests\User;

use App\Models\User\User;
use Eerzho\LaravelComponents\Http\Requests\BaseFromRequest\BaseFromRequest;
use Illuminate\Validation\Rule;

/**
 * @property User $user
 */
class UserRoleAttachRequest extends BaseFromRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'roles'   => [
                'required',
                'array',
            ],
            'roles.*' => [
                'bail',
                'required',
                'integer',
                Rule::exists('roles', 'id'),
                Rule::unique('user_role_assignment', 'role_id')
                    ->where('user_id', $this->user->id)
            ]
        ];
    }
}
