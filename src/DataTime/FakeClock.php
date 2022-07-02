<?php

namespace App\DataTime;

class FakeClock implements ClockInterface
{

    public function isNight(): bool
    {
        return false;
    }
}
