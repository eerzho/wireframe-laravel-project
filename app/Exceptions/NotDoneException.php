<?php

namespace App\Exceptions;

use App\Interfaces\BaseException\BaseExceptionInterface;
use Exception;

class NotDoneException extends Exception implements BaseExceptionInterface
{
    protected $code = 400;
}
