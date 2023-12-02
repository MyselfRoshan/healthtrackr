<?php

declare(strict_types=1);

namespace App\Enums;

enum ActivityCategory: int
{
    case Exercise = 0;
    case Water = 1;
    case Food = 2;
    case Sleep = 3;

    public function toString(): string
    {
        return match ($this) {
            self::Exercise  => 'Exercise',
            self::Water   => 'Water',
            self::Food => 'Food',
            self::Sleep => 'Sleep'
        };
    }
}
