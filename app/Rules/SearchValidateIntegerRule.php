<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SearchValidateIntegerRule implements Rule
{
    /**
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_array($value)) {
            foreach ($value as $v) {
                if (!ctype_digit((string)$v)) {
                    return false;
                }
            }

            return true;
        }

        return ctype_digit((string)$value);
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return ':attribute содержит некорректное значение';
    }
}
