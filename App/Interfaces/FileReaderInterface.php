<?php

namespace App\Interfaces;

use App\DTO\BookDTO;

interface FileReaderInterface
{
    public function getData(string $filePath): array;
}