<?php

namespace App\BookAdd;

use App\Exception\FileException;
use App\Exception\InvalidParameters;
use App\Interfaces\ValidationInterface;
use App\Request;
use App\Traits\ValidationTrait;


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

        if (count($arrayKeysRequest) !== 1 || !in_array('paths', $arrayKeysRequest)) {
            throw new InvalidParameters(
                'Error: 1 parameter is required. ("Paths") ' . implode(",", $arrayKeysRequest) . ' Given!'
            );
        }

        foreach ($arrayRequest as $key => $value) {
            if (strtolower($key) === 'paths') {
                if (!is_array($value) && !is_string($value)) {
                    throw new InvalidParameters('Error: Paths must be a string or an array!');
                }

                if (is_array($value)) {
                    foreach ($value as $filepath) {
                        if (!is_string($filepath)) {
                            throw new InvalidParameters('Error: Filepath in paths array must be a string!');
                        }
                        if (!str_ends_with($filepath, '.json') && !str_ends_with($filepath, '.csv')) {
                            throw new FileException('Error: Unrecognized file format!');
                        }
                        file_get_contents($filepath);
                    }
                } else {
                    if (!str_ends_with($value, '.json') && !str_ends_with($value, '.csv')) {
                        throw new FileException('Error: Unrecognized file format!');
                    }
                    file_get_contents($value);
                }
            }
        }
    }
}