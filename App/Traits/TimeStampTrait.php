<?php

namespace App\Traits;

use DateTime;

trait TimeStampTrait
{
    public function getTimeStampedDate(string $stringDate): DateTime
    {
        return (new DateTime())->setTimestamp((strtotime($stringDate)));
    }
}