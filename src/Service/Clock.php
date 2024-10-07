<?php

declare(strict_types=1);

namespace App\Service;

use DateTimeImmutable;

final class Clock implements ClockInterface
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now');
    }
}
