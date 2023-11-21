<?php

namespace App\BookUpdate;

use App\DTO\BookDTO;
use App\Request;
use App\Traits\TimeStampTrait;

class UpdateBooksData
{
    use TimeStampTrait;

    /**
     * @param array $bookData
     */
    public function __construct(public array $bookData)
    {
    }

    public function updateBooks(Request $request): BookDTO
    {
        $parameters = $request->request->parameters->replace;
        foreach ($parameters as $key => $value) {
            foreach ($this->bookData as $book) {
                if ($key == 'ISBN') {
                    echo 'ISBN cannot be change!' . '<br>';
                } elseif (in_array($key, array_keys(get_object_vars($book)))) {
                    $book->$key = $value;
                } else {
                    echo $key . ' not exists' . '<br>';
                }
            }
        }

        return new BookDTO($this->getTimeStampedArray($this->bookData));
    }
}