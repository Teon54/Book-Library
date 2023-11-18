<?php

namespace App;

interface ValidationInterface
{

    public function checkValidate(Request $request):void;
}