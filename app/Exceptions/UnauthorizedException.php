<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    protected $code = 401;
}
