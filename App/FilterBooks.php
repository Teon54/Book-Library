<?php

namespace App;

class FilterBooks
{
    use SearchTraits;

    public function __construct(public array $booksData)
    {
    }

    public function filterBooks(Request $request): array
    {
        $parameters = $request->request->parameters;
        $resultSearches = [];
        foreach ($parameters as $key => $parameter) {
            if (strtolower($key) === 'authors' || strtolower($key) === 'author') {
                if (is_array($parameter)){
                    foreach ($parameter as $author) {
                        $resultSearch = $this->searchByAuthor($this->booksData, $author);
                        if (!$resultSearch){
                            continue;
                        }
                        array_push($resultSearches,...$resultSearch);
                    }
                } else {
                    $resultSearch = $this->searchByAuthor($this->booksData, $parameter);
                    if (!$resultSearch){
                        continue;
                    }
                    array_push($resultSearches,...$resultSearch);
                }
            }
            if (strtolower($key) === 'titles' || strtolower($key) === 'title') {
                if (is_array($parameter)) {
                    foreach ($parameter as $title) {
                        $resultSearch = $this->searchByTitle($this->booksData, $title);
                        if (!$resultSearch) {
                            continue;
                        }
                        array_push($resultSearches, ...$resultSearch);
                    }
                } else {
                    $resultSearch = $this->searchByTitle($this->booksData, $parameter);
                    if (!$resultSearch) {
                        continue;
                    }
                    array_push($resultSearches, ...$resultSearch);
                }
            }
        }
        return $resultSearches;
    }
}