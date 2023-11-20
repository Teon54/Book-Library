<?php

namespace App\Traits;

trait HandleSearchTrait
{
    private function handleParameter($parameter, $searchFunction, &$resultSearches): void
    {
        if (is_array($parameter)) {
            foreach ($parameter as $value) {
                $resultSearch = $this->$searchFunction($this->booksData, $value);
                if ($resultSearch) {
                    $resultSearches = [...$resultSearches, ...$resultSearch];
                }
            }
        } else {
            $resultSearch = $this->$searchFunction($this->booksData, $parameter);
            if ($resultSearch) {
                $resultSearches = [...$resultSearches, ...$resultSearch];
            }
        }
    }
}