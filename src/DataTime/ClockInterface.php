<?php

namespace App\DataTime;

interface ClockInterface
{
    public function isNight(): bool;
}
