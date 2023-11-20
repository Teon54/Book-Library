<?php

namespace App\BookSearch;

use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;
use App\Interfaces\BookInterface;
use App\Request;
use App\Traits\DisplayBooksTrait;

class BookSearch implements BookInterface
{
    use DisplayBooksTrait;

    public function handle(Request $request): void
    {
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $booksData = $bookDataJson->add($bookDataCsv);
        $filteredBooksData = (new SpecificBook($booksData->bookData))->filterBooks($request);
        $this->displayBooks($filteredBooksData);
    }
}