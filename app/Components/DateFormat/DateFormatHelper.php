<?php

namespace App\Components\DateFormat;

/**
 * Class DateFormatHelper
 */
class DateFormatHelper
{
    const DATE_FORMAT               = 'Y-m-d';
    const TIME_FORMAT               = 'H:i';
    const DATETIME_FORMAT           = self::DATE_FORMAT . ' ' . self::TIME_FORMAT;
    const CAST_DATE_FORMAT          = 'date:' . self::DATE_FORMAT;
    const CAST_DATETIME_FORMAT      = 'datetime:' . self::DATETIME_FORMAT;
    const DATETIME_VALIDATOR_FORMAT = 'date_format:' . self::DATETIME_FORMAT;
    const DATE_VALIDATOR_FORMAT     = 'date_format:' . self::DATE_FORMAT;
}
