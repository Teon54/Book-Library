<?php

namespace App\Traits;

use App\DTO\BookDTO;

trait DisplayBooksTrait
{
    public function displayBooks(?BookDTO $booksData): void
    {
        if ($booksData === null) {
            echo 'there is no book!';
        } else {
            foreach ($booksData->bookData as $index => $book) {
                echo $index + 1 . ' :' . '<br>';
                print_r($book);
                echo '<br>' . '---------------------------------' . '<br>';
            }
        }
    }
}