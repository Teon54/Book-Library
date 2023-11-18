<?php

namespace App;

interface BookInterface
{
    public function handle(Request $request):void;
}