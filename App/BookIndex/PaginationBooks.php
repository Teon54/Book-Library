<?php

namespace App\BookIndex;

use App\DTO\BookDTO;
use App\Request;

class PaginationBooks
{

    public function getPaginatedBooks(array $booksData, Request $request): ?array
    {
        $arrayRequest = get_object_vars($request->request->parameters);
        $arrayRequest = array_map(function ($value) {
            return is_string($value) ? strtolower($value) : $value;
        }
            , $arrayRequest);
        $arrayRequest = array_change_key_case($arrayRequest);
        $paginatedBooksData = array_chunk($booksData, $arrayRequest['perpage']);
        if ($arrayRequest['page'] - 1 >= count($paginatedBooksData)) {
            return null;
        } else {
            return $paginatedBooksData[$arrayRequest['page'] - 1];
        }
    }
}