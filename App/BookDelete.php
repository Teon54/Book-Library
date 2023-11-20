<?php

namespace App;

use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;

class BookDelete implements BookInterface
{
    use DisplayBooksTrait;

    public function handle(Request $request): void
    {
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $booksData = $bookDataJson->add($bookDataCsv);
        $filteredBooksData = (new SpecificBook($booksData->bookData))->filterBooks($request);
        echo count($filteredBooksData->bookData) . ' Item founded: ' . '<br>';
        $this->displayBooks($filteredBooksData);
        $indexBook = null;
        if (count($filteredBooksData->bookData) > 0){
            $indexBook = array_search($filteredBooksData->bookData, $booksData->bookData);
        }
        unset($booksData->bookData[$indexBook]);
        $booksData->bookData = array_values($booksData->bookData);
        $this->displayBooks($booksData);
    }
}