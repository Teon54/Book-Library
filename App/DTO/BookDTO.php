<?php

namespace App\DTO;

class BookDTO
{
    public function __construct(public array $bookData)
    {
    }
    public function add(BookDTO $booksData):BookDTO{
        array_push($this->bookData,...$booksData->bookData);
        return $this;
    }
}