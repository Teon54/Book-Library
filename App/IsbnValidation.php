<?php

namespace App;

use App\DTO\BookDTO;
use Biblys\Isbn\Isbn;
use Biblys\Isbn\IsbnValidationException;

class IsbnValidation
{

    public function checkValidate(BookDTO $booksData): void
    {
        foreach ($booksData->bookData as $index => $book)
        try {
            Isbn::validateAsEan13(str_replace("-", "", $book->ISBN));
        }
        catch (IsbnValidationException $e) {
            unset($booksData->bookData[$index]);
            echo $e->getMessage() . '<br>';
        }
    }
}