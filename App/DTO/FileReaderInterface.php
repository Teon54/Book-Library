<?php

namespace App\DTO;

interface FileReaderInterface
{
    public function getData(string $filePath):BookDTO;
}