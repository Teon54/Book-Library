<?php

namespace App;

class PaginationBooks
{

    public function getPaginatedBooks(array $booksData,Request $request): ?array{
        $arrayRequest = get_object_vars($request->request->parameters);
        $arrayRequest = array_map(function ($value) {
            return is_string($value) ? strtolower($value) : $value;
        }
            , $arrayRequest);
        $arrayRequest = array_change_key_case($arrayRequest);
        $paginatedBooksData = array_chunk($booksData,$arrayRequest['perpage']);
        return $arrayRequest['page'] > count($paginatedBooksData) ? null : $paginatedBooksData[$arrayRequest['page']];
    }
}