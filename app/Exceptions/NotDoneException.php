<?php

namespace App\Exceptions;

use Eerzho\LaravelComponents\Interfaces\BaseException\BaseExceptionInterface;
use Exception;

class NotDoneException extends Exception implements BaseExceptionInterface
{
    protected $code = 400;
}
