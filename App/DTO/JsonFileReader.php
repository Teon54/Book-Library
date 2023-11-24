<?php

namespace App\DTO;


use App\BookAdd\IsbnValidation;
use App\Interfaces\FileReaderInterface;
use App\Traits\TimeStampTrait;

class JsonFileReader implements FileReaderInterface
{
    use TimeStampTrait;

    public function getData(string $filePath): array
    {
        $booksDto = [];
        $booksData = json_decode(file_get_contents(__DIR__ . "/../../" . $filePath))->books;
        foreach ($booksData as $book) {
            $booksDto[] = new BookDTO(
                $book->ISBN,
                $book->bookTitle,
                $book->authorName,
                $book->pagesCount,
                $this->getTimeStampedDate($book->publishDate)
            );
        }
        (new IsbnValidation())->checkValidate($booksDto);
        return $booksDto;
    }
}