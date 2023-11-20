<?php

namespace App;

use App\Exception\InvalidParameters;

class BookAddValidation implements ValidationInterface
{
    use ValidationTrait;

    /**
     * @throws InvalidParameters
     */
    public function checkValidate(Request $request): void
    {
        [$arrayRequest, $arrayKeysRequest] = $this->globalValidation($request);
        if (!in_array('paths', $arrayKeysRequest)) {
            throw new InvalidParameters(
                'Error: 1 parameters are required. ("Paths") ' . implode(
                    ",",
                    $arrayKeysRequest
                ) . ' Given!'
            );
        }

        if (count($arrayKeysRequest) > 1) {
            throw new InvalidParameters(
                'Error: 1 parameters are required. ("paths") ' . count(
                    $arrayKeysRequest
                ) . ' Given!'
            );
        }
        foreach ($arrayRequest as $key => $value) {
            if (strtolower($key) === 'paths' & !(is_array($value) || is_string($value))) {
                throw new InvalidParameters('Error: Paths must be string or array!');
            }
        }
    }
}