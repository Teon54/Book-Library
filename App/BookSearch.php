<?php

namespace App;

use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;

class BookSearch implements BookInterface
{

    public function handle(Request $request): void
    {
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $booksData = array_merge($bookDataCsv->bookData, $bookDataJson->bookData);
        $filteredBooksData = (new SpecificBook($booksData))->filterBooks($request);
        var_dump($filteredBooksData);
    }
}