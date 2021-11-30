<?php

namespace App\Http\Requests\Role;

use App\Models\Role\Role;
use Eerzho\LaravelComponents\Http\Requests\BaseFromRequest\BaseFromRequest;
use Illuminate\Validation\Rule;

/**
 * @property Role $role
 */
class RoleUpdateRequest extends BaseFromRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
                'min:3',
                'max:255',
                Rule::unique('roles', 'name')
                    ->ignore($this->role->id)
            ]
        ];
    }
}
