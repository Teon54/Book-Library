<?php

namespace App\Traits;

use App\DTO\BookDTO;

trait DisplayBooksTrait
{
    public function displayBooks(BookDTO $booksData): void
    {
        foreach ($booksData->bookData as $index => $book) {
            echo $index . ' :' . '<br>';
            print_r($book);
            echo '<br>' . '---------------------------------' . '<br>';
        }
    }
}