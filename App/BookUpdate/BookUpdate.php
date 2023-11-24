<?php

namespace App\BookUpdate;

use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;
use App\Interfaces\BookInterface;
use App\Request;
use App\Traits\DisplayBooksTrait;

class BookUpdate implements BookInterface
{
    use DisplayBooksTrait;

    public function handle(Request $request): void
    {
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $booksData = array_merge($bookDataJson, $bookDataCsv);
        $filteredBooksData = (new SearchBook($booksData))->filterBooks($request);
        $updatedBooksData = (new UpdateBooksData($filteredBooksData))->updateBooks($request);
        $this->displayBooks($updatedBooksData);
    }
}