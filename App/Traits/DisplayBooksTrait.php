<?php

namespace App\Traits;

trait DisplayBooksTrait
{
    public function displayBooks(?array $booksData): void
    {
        if ($booksData === null) {
            echo 'there is no book!';
        } else {
            foreach ($booksData as $index => $book) {
                echo $index + 1 . ' :' . '<br>';
                print_r($book);
                echo '<br>' . '---------------------------------' . '<br>';
            }
        }
    }
}