<?php

namespace App;

use App\BookAdd\BookAdd;
use App\BookAdd\BookAddValidation;
use App\BookDelete\BookDelete;
use App\BookDelete\BookDeleteValidation;
use App\BookIndex\BookIndex;
use App\BookIndex\BookIndexValidation;
use App\BookSearch\BookSearch;
use App\BookSearch\BookSearchValidation;
use App\BookUpdate\BookUpdate;
use App\BookUpdate\BookUpdateValidation;
use App\Exception\FileException;
use App\Exception\InvalidCommandNameException;
use App\Exception\InvalidParameters;

class TaskManager
{
    public Request $request;
    public function __construct(string $commandFilePath)
    {
        $commandFileContent = json_decode(file_get_contents(__DIR__ . '/../' . $commandFilePath));
        $this->request = new Request($commandFileContent->command_name,$commandFileContent->parameters);
    }

    /**
     * @throws InvalidCommandNameException
     * @throws InvalidParameters
     * @throws FileException
     */
    public function manageTask(): void
    {
        switch (strtolower($this->request->commandName)) {
            case('bookindex'):
                (new BookIndexValidation())->checkValidate($this->request);
                (new BookIndex())->handle($this->request);
                break;
            case('getbook'):
                (new BookSearchValidation())->checkValidate($this->request);
                (new BookSearch())->handle($this->request);
                break;
            case('addbook'):
                (new BookAddValidation())->checkValidate($this->request);
                (new BookAdd())->handle($this->request);
                break;
            case('deletebook'):
                (new BookDeleteValidation())->checkValidate($this->request);
                (new BookDelete())->handle($this->request);
                break;
            case('updatebooks'):
                (new BookUpdateValidation())->checkValidate($this->request);
                (new BookUpdate())->handle($this->request);
                break;
            default:
                throw new InvalidCommandNameException();
        }
    }
}