<?php

namespace App\Interfaces;

use App\Request;

interface BookInterface
{
    public function handle(Request $request): void;
}