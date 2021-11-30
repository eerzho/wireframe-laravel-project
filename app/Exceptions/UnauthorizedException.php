<?php

namespace App\Exceptions;

use Eerzho\LaravelComponents\Interfaces\BaseException\BaseExceptionInterface;
use Exception;

class UnauthorizedException extends Exception implements BaseExceptionInterface
{
    protected $code = 401;
}
