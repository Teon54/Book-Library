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
        $booksData = array_merge($bookDataJson, $bookDataCsv);
        $sortedBooksData = (new DateSorter($booksData))->sortBooks('ascending');
        $filteredBooksData = (new FilterBooks($sortedBooksData))->filterBooks($request);
        $paginatedBooksData = (new Pagination())->getPaginatedBooks($filteredBooksData, $request);
        $this->displayBooks($paginatedBooksData);
    }
}