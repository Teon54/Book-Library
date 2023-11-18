<?php

namespace App\DTO;

use App\TimeStampTrait;

class JsonFileReader implements FileReaderInterface
{
    use TimeStampTrait;
    public function getData(string $filePath): BookDTO
    {
        $booksData = json_decode(file_get_contents(__DIR__ . "/../../" . $filePath))->books;
        return new BookDTO($this->getTimeStampedArray($booksData));
    }
}