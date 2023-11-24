<?php

namespace App\BookIndex;

use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;
use App\Interfaces\BookInterface;
use App\Request;
use App\Traits\DisplayBooksTrait;

class BookIndex implements BookInterface
{
    use DisplayBooksTrait;

    public function handle(Request $request): void
    {
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $booksData = $bookDataJson->add($bookDataCsv);
        $sortedBooksData = (new Sort($booksData->bookData))->sortBooks('ascending');
        $filteredBooksData = (new FilterBooks($sortedBooksData->bookData))->filterBooks($request);
        $paginatedBooksData = (new PaginationBooks())->getPaginatedBooks($filteredBooksData->bookData, $request);
        $this->displayBooks($paginatedBooksData);
    }
}