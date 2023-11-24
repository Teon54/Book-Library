<?php

namespace App\BookAdd;

use App\Exception\InvalidParameters;
use App\Interfaces\ValidationInterface;
use App\Request;
use App\Traits\ValidationTrait;


class BookAddValidation implements ValidationInterface
{
    use ValidationTrait;

    /**
     * @throws InvalidParameters
     */
    public function checkValidate(Request $request): void
    {
        [$arrayRequest, $arrayKeysRequest] = $this->globalValidation($request);

        if (count($arrayKeysRequest) !== 1 || !in_array('books', $arrayKeysRequest)) {
            throw new InvalidParameters(
                'Error: 1 parameter is required. ("books") ' . implode(",", $arrayKeysRequest) . ' Given!'
            );
        }

        foreach ($arrayRequest as $key => $value) {
            if (strtolower($key) === 'books') {
                if (!is_array($value)) {
                    throw new InvalidParameters('Error: books must be a array of object!');
                }
                foreach ($value as $book) {
                    if (!is_object($book)) {
                        throw new InvalidParameters('Error: every book in books array must be a object!');
                    }
                }
            }
        }
    }
}