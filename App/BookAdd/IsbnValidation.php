<?php

namespace App\BookAdd;

use Biblys\Isbn\Isbn;
use Biblys\Isbn\IsbnValidationException;

class IsbnValidation
{

    public function checkValidate(array &$booksData): void
    {
        foreach ($booksData as $index => $book) {
            try {
                Isbn::validateAsEan13(str_replace("-", "", $book->ISBN));
            } catch (IsbnValidationException $e) {
                unset($booksData[$index]);
                echo $e->getMessage() . ' in object:' . '<br>';
                print_r($book);
                echo '<br>' . '-------------------------' . '<br>';
            }
        }
    }
}