<?php

namespace App;

use App\Exception\InvalidParameters;

trait ValidationTrait
{
    /**
     * @throws InvalidParameters
     */
    public function globalValidation(Request $request):array{
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
        return [$arrayRequest,$arrayKeysRequest];
    }
}