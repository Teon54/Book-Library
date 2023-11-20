<?php

namespace App\BookUpdate;

use App\DTO\BookDTO;
use App\Request;
use App\Traits\HandleSearchTrait;
use App\Traits\SearchTrait;

class SearchBook
{
    use SearchTrait;
    use HandleSearchTrait;

    /**
     * @param array $booksData
     */
    public function __construct(public array $booksData)
    {
    }

    public function filterBooks(Request $request): BookDTO
    {
        $parameters = $request->request->parameters->search;
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
                case 'isbn':
                case 'isbns':
                    $this->handleParameter($parameter, 'searchByISBN', $resultSearches);
                    break;
                default:
                    echo 'key : ' . $key . ' not exists';
                    break;
            }
        }

        return new BookDTO($resultSearches);
    }
}