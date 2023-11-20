<?php

namespace App\DTO;


use App\BookAdd\IsbnValidation;
use App\Interfaces\FileReaderInterface;
use App\Traits\TimeStampTrait;

class JsonFileReader implements FileReaderInterface
{
    use TimeStampTrait;

    public function getData(string $filePath): BookDTO
    {
        $booksData = json_decode(file_get_contents(__DIR__ . "/../../" . $filePath))->books;
        $booksDataDTO = new BookDTO($this->getTimeStampedArray($booksData));
        (new IsbnValidation())->checkValidate($booksDataDTO);
        return $booksDataDTO;
    }
}