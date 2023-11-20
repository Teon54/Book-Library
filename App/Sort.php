<?php

namespace App;

use App\DTO\BookDTO;

class Sort
{
    public function __construct(public array $booksData, public ?string $typeSort = 'ascending')
    {
    }

    private function compare(object $a, object $b): int
    {
        $result = $a->publishDate <=> $b->publishDate;
        return $this->typeSort === 'ascending' ? $result : -1 * $result;
    }

    public function sortBooks(string $typeSort): BookDTO
    {
        $tempArray = $this->booksData;
        $this->typeSort = $typeSort;
        usort($tempArray, [$this, 'compare']);
        return new BookDTO($tempArray);
    }
}