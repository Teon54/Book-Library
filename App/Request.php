<?php

namespace App;

use App\Exception\InvalidCommandNameException;

class Request
{
    /**
     * @throws InvalidCommandNameException
     */
    public function __construct(string $commandFilePath, public ?\stdClass $request = null)
    {
        $this->request = json_decode(file_get_contents(__DIR__ . '/../' . $commandFilePath));
        switch (strtolower($this->request->command_name)){
            case('bookindex'):
                new BookIndexValidation($request);
                break;
            default:
                throw new InvalidCommandNameException();
        }
    }
}