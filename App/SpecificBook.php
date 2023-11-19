<?php

namespace App;

class SpecificBook
{
    use SearchTraits;

    /**
     * @param array $booksData
     */
    public function __construct(public array $booksData)
    {
    }

    public function filterBooks(Request $request): array
    {
        $parameters = $request->request->parameters;
        return $this->searchByIsbn($this->booksData, $parameters->ISBN);
    }
}