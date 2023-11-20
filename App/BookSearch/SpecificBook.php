<?php

namespace App\BookSearch;

use App\DTO\BookDTO;
use App\Request;
use App\Traits\SearchTrait;

class SpecificBook
{
    use SearchTrait;

    /**
     * @param array $booksData
     */
    public function __construct(public array $booksData)
    {
    }

    public function filterBooks(Request $request): BookDTO
    {
        $parameters = $request->request->parameters;
        return new BookDTO($this->searchByIsbn($this->booksData, $parameters->ISBN));
    }
}