<?php

namespace App;

use stdClass;

class Request
{
    public function __construct(public string $commandName, public stdClass $parameters)
    {
    }
}