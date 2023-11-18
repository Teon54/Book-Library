<?php

namespace App;

use App\Exception\InvalidCommandNameException;
use stdClass;

class Request
{
    /**
     * @throws InvalidCommandNameException
     */
    public function __construct(string $commandFilePath, public ?stdClass $request = null)
    {
        $this->request = json_decode(file_get_contents(__DIR__ . '/../' . $commandFilePath));
        switch (strtolower($this->request->command_name)) {
            case('bookindex'):
                (new BookIndexValidation())->checkValidate($this);
                break;
            default:
                throw new InvalidCommandNameException();
        }
    }
}