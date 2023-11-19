<?php

namespace App;

use App\Exception\InvalidParameters;

class BookSearchValidation implements ValidationInterface
{

    /**
     * @throws InvalidParameters
     */
    public function checkValidate(Request $request): void
    {
        $arrayRequest = get_object_vars($request->request->parameters);
        $arrayRequest = array_map(function ($value) {
            return is_string($value) ? strtolower($value) : $value;
        }
            , $arrayRequest);
        $arrayRequest = array_change_key_case($arrayRequest);
        $arrayKeysRequest = array_keys($arrayRequest);
        $arrayKeysRequest = array_map(fn($item) => strtolower($item), $arrayKeysRequest);
        if (!is_object($request->request)) {
            throw new InvalidParameters('Error: Your parameter must be an object!');
        }
        if (!in_array('isbn', $arrayKeysRequest)) {
            throw new InvalidParameters(
                'Error: 1 parameters are required. ("ISBN") ' . implode(
                    ",",
                    $arrayKeysRequest
                ) . ' Given!'
            );
        }

        if (count($arrayKeysRequest) > 1) {
            throw new InvalidParameters(
                'Error: 1 parameters are required. ("isbn") ' . count(
                    $arrayKeysRequest
                ) . ' Given!'
            );
        }
        foreach ($arrayRequest as $key => $value) {
            if (strtolower($key) === 'isbn' & !is_string($value)) {
                throw new InvalidParameters('Error: ISBN must be string!');
            }
        }
    }
}