<?php

namespace App;

use App\DTO\BookDTO;

class PaginationBooks
{

    public function getPaginatedBooks(array $booksData, Request $request): ?BookDTO
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
            return new BookDTO($paginatedBooksData[$arrayRequest['page'] - 1]);
        }
    }
}