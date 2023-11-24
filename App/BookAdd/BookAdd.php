<?php

namespace App\BookAdd;


use App\DTO\BookDTO;
use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;
use App\Interfaces\BookInterface;
use App\Request;
use App\Traits\DisplayBooksTrait;
use App\Traits\TimeStampTrait;

class BookAdd implements BookInterface
{
    use DisplayBooksTrait;
    use TimeStampTrait;

    public function handle(Request $request): void
    {
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $newBooksArray = $request->parameters->books;
        $newBooksData = $this->createNewArrayOfBookDto($newBooksArray);
        $booksData = array_merge($bookDataJson, $bookDataCsv, $newBooksData);
        $this->displayBooks($booksData);
    }

    private function createNewArrayOfBookDto(array $books): array
    {
        $newBooksDto = [];
        foreach ($books as $book) {
            $newBooksDto[] = new BookDTO(
                $book->ISBN,
                $book->bookTitle,
                $book->authorName,
                $book->pagesCount,
                $this->getTimeStampedDate($book->publishDate)
            );
        }
        (new IsbnValidation())->checkValidate($newBooksDto);
        return $newBooksDto;
    }
}