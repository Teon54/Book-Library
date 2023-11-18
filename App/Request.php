<?php

namespace App;

class Request
{
    public function __construct(string $commandFilePath, public ?\stdClass $request = null)
    {
        $this->request = json_decode(file_get_contents(__DIR__ . '/../' . $commandFilePath));
    }
}