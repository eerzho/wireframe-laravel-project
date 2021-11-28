<?php

namespace App\Constants\BaseConst;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;

class BaseConst
{
    private static $contants;
    private static $arr;
    private static $collection;

    /**
     * @return array
     */
    private static function getConstants()
    {
        $reflectionClass = new ReflectionClass(static::class);

        return self::$contants ?: self::$contants = $reflectionClass->getConstants();
    }

    /**
     * @return array
     */
    public static function getArr()
    {
        $res = [];
        foreach (self::getConstants() as $key => $value) {
            $res[] = [
                'name' => Str::lower($key),
                'value' => $value
            ];
        }

        return self::$arr ?: self::$arr = $res;
    }

    /**
     * @return Collection
     */
    public static function getCollection()
    {
        return self::$collection ?: self::$collection = Collection::make(self::getArr());
    }
}
