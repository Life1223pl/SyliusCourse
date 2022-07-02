<?php

namespace App\DataTime;

class Clock implements ClockInterface
{

    public function isNight(): bool
    {
        $currentHour = (int)(new \DateTime())->format('H');

        return $currentHour > 19 || $currentHour < 6;
    }
}
