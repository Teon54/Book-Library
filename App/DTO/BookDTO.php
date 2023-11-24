<?php

namespace App\DTO;

use DateTime;

class BookDTO
{
    public function __construct(
        public string $ISBN,
        public string $bookTitle,
        public string $authorName,
        public int $pagesCount,
        public DateTime $publishDate
    ) {
    }
}