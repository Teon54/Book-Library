<?php

namespace App\Interfaces;

use App\Request;

interface ValidationInterface
{
    public function checkValidate(Request $request): void;
}