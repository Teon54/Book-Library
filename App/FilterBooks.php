<?php

namespace App;

use App\DTO\BookDTO;

class FilterBooks
{
    use SearchTrait;
    use HandleSearchTrait;

    public function __construct(public array $booksData)
    {
    }

    public function filterBooks(Request $request): BookDTO
    {
        $parameters = $request->request->parameters;
        $resultSearches = [];

        foreach ($parameters as $key => $parameter) {
            $lowerKey = strtolower($key);
            switch ($lowerKey) {
                case 'authors':
                case 'author':
                    $this->handleParameter($parameter, 'searchByAuthor', $resultSearches);
                    break;
                case 'titles':
                case 'title':
                    $this->handleParameter($parameter, 'searchByTitle', $resultSearches);
                    break;
                default:
                    echo 'key : ' . $key . ' not exists';
                    break;
            }
        }

        return new BookDTO($resultSearches);
    }
}