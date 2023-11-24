<?php

namespace App\BookDelete;

use App\BookSearch\SpecificBook;
use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;
use App\Interfaces\BookInterface;
use App\Request;
use App\Traits\DisplayBooksTrait;

class BookDelete implements BookInterface
{
    use DisplayBooksTrait;

    public function handle(Request $request): void
    {
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $booksData = array_merge($bookDataJson, $bookDataCsv);
        $filteredBooksData = (new SpecificBook($booksData))->filterBooks($request);
        echo count($filteredBooksData) . ' Item deleted: ' . '<br>';
        $this->displayBooks($filteredBooksData);
        $indexBook = null;
        if (count($filteredBooksData) > 0) {
            $indexBook = array_search($filteredBooksData[0], $booksData);
        }
        unset($booksData[$indexBook]);
        $booksData = array_values($booksData);
        $this->displayBooks($booksData);
    }
}