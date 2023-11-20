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
use stdClass;

class Request
{
    /**
     * @throws InvalidCommandNameException
     * @throws InvalidParameters
     * @throws FileException
     */
    public function __construct(string $commandFilePath, public ?stdClass $request = null)
    {
        $this->request = json_decode(file_get_contents(__DIR__ . '/../' . $commandFilePath));
        switch (strtolower($this->request->command_name)) {
            case('bookindex'):
                (new BookIndexValidation())->checkValidate($this);
                (new BookIndex())->handle($this);
                break;
            case('getbook'):
                (new BookSearchValidation())->checkValidate($this);
                (new BookSearch())->handle($this);
                break;
            case('addbook'):
                (new BookAddValidation())->checkValidate($this);
                (new BookAdd())->handle($this);
                break;
            case('deletebook'):
                (new BookDeleteValidation())->checkValidate($this);
                (new BookDelete())->handle($this);
                break;
            case('updatebooks'):
                (new BookUpdateValidation())->checkValidate($this);
                (new BookUpdate())->handle($this);
                break;
            default:
                throw new InvalidCommandNameException();
        }
    }
}