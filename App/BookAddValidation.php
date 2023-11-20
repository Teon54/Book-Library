<?php

namespace App;

use App\Exception\FileException;
use App\Exception\InvalidParameters;

class BookAddValidation implements ValidationInterface
{
    use ValidationTrait;

    /**
     * @throws InvalidParameters
     * @throws FileException
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
            if (strtolower($key) === 'paths') {
                if (!(is_array($value) || is_string($value))){
                    throw new InvalidParameters('Error: Paths must be string or array!');
                }
                if (is_array($value)){
                    foreach ($value as $filepath){
                        file_get_contents($filepath);
                    }
                } else {
                    if (str_ends_with($value,'.json') || str_ends_with($value,'.csv')){
                        throw new FileException('Error: Format file not recognized!');
                    }
                    file_get_contents($value);
                }
            }
        }
    }
}