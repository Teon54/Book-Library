<?php

namespace App;

use App\DTO\BookDTO;

class SpecificBook
{
    use SearchTraits;

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