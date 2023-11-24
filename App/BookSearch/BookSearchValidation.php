<?php

namespace App\BookSearch;

use App\Exception\InvalidParameters;
use App\Interfaces\ValidationInterface;
use App\Request;
use App\Traits\ValidationTrait;

class BookSearchValidation implements ValidationInterface
{
    use ValidationTrait;

    /**
     * @throws InvalidParameters
     */
    public function checkValidate(Request $request): void
    {
        [$arrayRequest, $arrayKeysRequest] = $this->globalValidation($request);

        if (count($arrayKeysRequest) !== 1 || !in_array('isbn', $arrayKeysRequest)) {
            throw new InvalidParameters(
                'Error: 1 parameter is required. ("ISBN") ' . implode(",", $arrayKeysRequest) . ' Given!'
            );
        }

        foreach ($arrayRequest as $key => $value) {
            if (strtolower($key) === 'isbn' && !is_string($value)) {
                throw new InvalidParameters('Error: ISBN must be a string!');
            }
        }
    }
}