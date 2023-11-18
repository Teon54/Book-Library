<?php

namespace App\DTO;

use App\TimeStampTrait;
use stdClass;

class CsvFileReader implements FileReaderInterface
{

    use TimeStampTrait;

    public function getData(string $filePath): BookDTO
    {
        $file = fopen("./" . $filePath, 'r');
        $columnTitles = fgetcsv($file);
        $dataObjects = array();

        while ($data = fgetcsv($file)) {
            $dataObject = new stdClass();

            foreach ($columnTitles as $index => $title) {
                $dataObject->$title = $data[$index];
            }

            $dataObjects[] = $dataObject;
        }

        fclose($file);
        return new BookDTO($this->getTimeStampedArray($dataObjects));
    }
}