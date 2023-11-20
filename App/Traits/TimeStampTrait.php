<?php

namespace App\Traits;

use DateTime;

trait TimeStampTrait
{
    public function getTimeStampedArray($booksData): array
    {
        foreach ($booksData as $book) {
            if ($book->publishDate instanceof DateTime) {
                continue;
            }
            $book->publishDate = (new DateTime())->setTimestamp((strtotime($book->publishDate)));
        }
        return $booksData;
    }
}