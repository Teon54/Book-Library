<?php

namespace App\BookAdd;


use App\DTO\CsvFileReader;
use App\DTO\JsonFileReader;
use App\Interfaces\BookInterface;
use App\Request;
use App\Traits\DisplayBooksTrait;

class BookAdd implements BookInterface
{
    use DisplayBooksTrait;

    public function handle(Request $request): void
    {
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $booksData = array_merge($bookDataJson, $bookDataCsv);
        $paths = $request->parameters->paths;
        if (is_array($paths)) {
            foreach ($paths as $file) {
                if (str_ends_with($file, '.json')) {
                    $booksData = array_merge($booksData, (new JsonFileReader())->getData($file));
                } elseif (str_ends_with($file, '.csv')) {
                    $booksData = array_merge($booksData, (new CsvFileReader())->getData($file));
                }
            }
        } elseif (is_string($paths)) {
            if (str_ends_with($paths, '.json')) {
                $booksData = array_merge($booksData, (new JsonFileReader())->getData($paths));
            } elseif (str_ends_with($paths, '.csv')) {
                $booksData = array_merge($booksData, (new CsvFileReader())->getData($paths));
            }
        }
        $this->displayBooks($booksData);
    }
}