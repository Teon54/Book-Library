<?php

namespace App;

trait SearchTraits
{
    public function searchByAuthor(array $booksData, string $author): array
    {
        return array_values(array_filter($booksData, fn($item) => $item->authorName === $author));
    }

    public function searchByTitle(array $booksData, string $bookTitle): array
    {
        return array_values(array_filter($booksData, fn($item) => $item->bookTitle === $bookTitle));
    }

    public function searchByISBN(array $booksData, string $ISBN): array
    {
        return array_values(array_filter($booksData, fn($item) => $item->ISBN === $ISBN));
    }

    public function searchByDate(array $booksData, string $date): array
    {
        return array_values(
            array_filter($booksData, fn($item) => date('Y', $item->publishDate->getTimeStamp()) === $date)
        );
    }
}