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
        $bookDataJson = (new JsonFileReader())->getData('database/books.json');
        $bookDataCsv = (new CsvFileReader())->getData('database/books.csv');
        $bookDataJson->add($bookDataCsv);
        $paths = $request->request->parameters->paths;
        if (is_array($paths)) {
            foreach ($paths as $file) {
                if (str_ends_with($file, '.json')) {
                    $bookDataJson->add((new JsonFileReader())->getData($file));
                } elseif (str_ends_with($file, '.csv')) {
                    $bookDataJson->add((new CsvFileReader())->getData($file));
                }
            }
        } elseif (is_string($paths)) {
            if (str_ends_with($paths, '.json')) {
                $bookDataJson->add((new JsonFileReader())->getData($paths));
            } elseif (str_ends_with($paths, '.csv')) {
                $bookDataJson->add((new CsvFileReader())->getData($paths));
            }
        }

        $this->displayBooks($bookDataJson);
    }
}