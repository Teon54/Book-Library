<?php

namespace App;

use App\Exception\InvalidParameters;

class BookIndexValidation implements ValidationInterface
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
        if (!(in_array('perpage', $arrayKeysRequest) & in_array('page', $arrayKeysRequest))) {
            throw new InvalidParameters('Error: 2 parameters are required. ("perPage" and "page") ' . implode(",", $arrayKeysRequest) . ' Given!');
        }

        if (count($arrayKeysRequest) === 3 & !(in_array('author', $arrayKeysRequest) || in_array('authors', $arrayKeysRequest) || in_array('title', $arrayKeysRequest) || in_array('titles', $arrayKeysRequest))) {
            throw new InvalidParameters('Error: Optional parameters are authors and titles ("authors" and "titles" or "author" and "title")');
        }
        if (count($arrayKeysRequest) === 4 & !((in_array('author', $arrayKeysRequest) || in_array('authors', $arrayKeysRequest)) & (in_array('title', $arrayKeysRequest) || in_array('titles', $arrayKeysRequest)))) {
            throw new InvalidParameters('Error: Optional parameters are authors and titles ("authors" and "titles" or "author" and "title")');
        }
        if (count($arrayKeysRequest) > 4) {
            throw new InvalidParameters('Error: 2 parameters are required. ("perPage" and "page") and 2 parameters are optional ' . count($arrayKeysRequest) . ' Given!');
        }
        foreach ($arrayRequest as $key => $value) {
            if (strtolower($key) === 'perpage' & !is_int($value)) {
                throw new InvalidParameters('Error: Per Page must be integer!');
            }
            if (strtolower($key) === 'page' & !is_int($value)) {
                throw new InvalidParameters('Error: Page must be integer!');
            }
            if ((strtolower($key) === 'author' || strtolower($key) === 'authors') & !(is_string($value) || is_array($value))) {
                throw new InvalidParameters('Error: authors must be string or array!');
            }
            if ((strtolower($key) === 'title' || strtolower($key) === 'titles') & !(is_string($value) || is_array($value))) {
                throw new InvalidParameters('Error: titles must be string or array!');
            }
        }
        if (!$arrayRequest['perpage'] || !$arrayRequest['page']) {
            throw new InvalidParameters('Per Page and Page cannot be empty!');
        }
        if ($arrayRequest['perpage'] < 0 || $arrayRequest['page'] < 0){
            throw new InvalidParameters('Error : PerPage and Page must be positive!');
        }
    }
}