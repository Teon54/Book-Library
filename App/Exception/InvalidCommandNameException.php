<?php

namespace App\Exception;

use Exception;

class InvalidCommandNameException extends Exception
{
    protected $message = 'Command name is not valid';
}