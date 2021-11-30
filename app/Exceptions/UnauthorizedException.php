<?php

namespace App\Exceptions;

use App\Interfaces\BaseException\BaseExceptionInterface;
use Exception;

class UnauthorizedException extends Exception implements BaseExceptionInterface
{
    protected $code = 401;
}
