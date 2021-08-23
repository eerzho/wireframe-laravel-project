<?php

namespace App\Exceptions;

use Exception;

class NotDoneException extends Exception
{
    protected $code = 400;
}
