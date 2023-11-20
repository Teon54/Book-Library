<?php

namespace App;

use App\DTO\BookDTO;

trait DisplayBooksTrait
{
    public function displayBooks(BookDTO $booksData){
        foreach ($booksData->bookData as $index => $book){
            echo $index . ' :' . '<br>';
            print_r($book);
            echo '<br>' . '---------------------------------' . '<br>';
        }
    }
}