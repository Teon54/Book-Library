<?php

namespace App;

use App\Exception\InvalidCommandNameException;
use App\Exception\InvalidParameters;
use stdClass;

class Request
{
    /**
     * @throws InvalidCommandNameException
     * @throws InvalidParameters
     */
    public function __construct(string $commandFilePath, public ?stdClass $request = null)
    {
        $this->request = json_decode(file_get_contents(__DIR__ . '/../' . $commandFilePath));
        switch (strtolower($this->request->command_name)) {
            case('bookindex'):
                (new BookIndexValidation())->checkValidate($this);
                (new BookIndex())->handle($this);
                break;
            default:
                throw new InvalidCommandNameException();
        }
    }
}