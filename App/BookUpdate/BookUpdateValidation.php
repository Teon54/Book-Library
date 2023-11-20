<?php

namespace App\BookUpdate;

use App\Exception\InvalidParameters;
use App\Interfaces\ValidationInterface;
use App\Request;
use App\Traits\ValidationTrait;

class BookUpdateValidation implements ValidationInterface
{
    use ValidationTrait;

    /**
     * @throws InvalidParameters
     */
    public function checkValidate(Request $request): void
    {
        [$arrayRequest, $arrayKeysRequest] = $this->globalValidation($request);
        if (!in_array('search', $arrayKeysRequest) || !in_array('replace', $arrayKeysRequest)) {
            throw new InvalidParameters(
                'Error: 2 parameters are required. ("search", "replace") ' . implode(
                    ",",
                    $arrayKeysRequest
                ) . ' Given!'
            );
        }

        if (count($arrayKeysRequest) > 2) {
            throw new InvalidParameters(
                'Error: 2 parameters are required. ("search", "replace") ' . count(
                    $arrayKeysRequest
                ) . ' Given!'
            );
        }
        foreach ($arrayRequest as $key => $value) {
            if (strtolower($key) === 'search' & !is_object($value)) {
                throw new InvalidParameters('Error: search must be object!');
            } elseif (strtolower($key) === 'replace' & !is_object($value)) {
                throw new InvalidParameters('Error: replace must be object!');
            }
        }
    }
}