<?php

namespace App\DTO;

class BookDTO
{
    public function __construct(
        public string $ISBN,
        public string $bookTitle,
        public string $authorName,
        public int $pagesCount,
        public string $publishDate
    ) {
    }
}