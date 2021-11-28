<?php

namespace App\Components\UniqueValue;

use Illuminate\Support\Facades\DB;

class MakeUniqueValue
{
    /**
     * @param string $table
     * @param string $column
     * @param string $value
     *
     * @return string
     */
    public static function getValue(string $table, string $column, string $value)
    {
        $oldValue = DB::table($table)
            ->where($column, $value)
            ->orWhere($column, 'like', $value . '-%')
            ->latest('id')
            ->value($column);

        if ($oldValue) {
            $pieces = explode('-', $oldValue);
            $number = intval(end($pieces));
            $value .= '-' . ($number + 1);
        }

        return $value;
    }
}
