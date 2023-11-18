<?php

namespace App;

use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;

class BookIndex implements BookInterface
{

    public function handle(Request $request): void
    {
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $booksData = array_merge($bookDataCsv->bookData, $bookDataJson->bookData);
        $sortedBooksData = (new Sort($booksData))->sortBooks('ascending');
        $filteredBooksData = (new FilterBooks($sortedBooksData))->filterBooks($request);
        $paginatedBooksData = (new PaginationBooks())->getPaginatedBooks($filteredBooksData, $request);
        var_dump($paginatedBooksData);
    }
}