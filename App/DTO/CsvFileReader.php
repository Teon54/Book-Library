<?php

namespace App\DTO;

use App\BookAdd\IsbnValidation;
use App\Interfaces\FileReaderInterface;
use App\Traits\TimeStampTrait;
use stdClass;

class CsvFileReader implements FileReaderInterface
{

    use TimeStampTrait;

    public function getData(string $filePath): array
    {
        $file = fopen("./" . $filePath, 'r');
        $columnTitles = fgetcsv($file);
        $booksDTO = [];

        while ($data = fgetcsv($file)) {
            $book = new stdClass();
            foreach ($columnTitles as $index => $title) {
                $book->$title = $data[$index];
            }
            $booksDTO[] = new BookDTO($book->ISBN,$book->bookTitle,$book->authorName,$book->pagesCount,$this->getTimeStampedDate($book->publishDate));
        }
        fclose($file);
        (new IsbnValidation())->checkValidate($booksDTO);
        return $booksDTO;
    }
}